<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\UpdateRouteRequest;
use App\Models\Availability;
use App\Models\Category;
use App\Models\Route;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use DOMDocument;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $routes = Route::all();
        return view('admin.routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.routes.create', [
            'categories' => Category::all(),
            'availabilities' => Availability::all(),
            'regions' => Region::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRouteRequest $request)
    {

        // dd($request->categories);
        $data = $request->validated();

        $route = Route::create($data);
        $image = $data['url_image'];
        $imageName = time() . "_" .  $image->getClientOriginalName(); // оригинальное имя файла
        $directory = "routes/$route->id/image";
        $imagePath = $image->storeAs($directory, $imageName, 'public');
        $url_image = Storage::url($imagePath);
        $route['url_image'] = $url_image;
        $route->save();

        if (isset($data['categories'])) {

            $categories = $data['categories'];
            $newCategories = [];

            foreach ($categories as $id => $category) {

                if (Category::find($category)) {
                    $newCategories[$id] = $category;
                } else {
                    $newCategory = Category::firstOrCreate(['title' => $category]);
                    $newCategories[$id] = $newCategory->id;
                };
            }

            $route->categories()->sync($newCategories);
        }

        if (isset($data['availability'])) {

            $availabilities = $data['availability'];
            $newAvailabilities = [];

            foreach ($availabilities as $id => $availability) {
                if (Availability::find($availability)) {
                    $newAvailabilities[$id] = $availability;
                } else {
                    $newAvailability = Availability::firstOrCreate(['title' => $availability]);
                    $newAvailabilities[$id] = $newAvailability->id;
                };
            }

            $route->availabilities()->sync($newAvailabilities);
        }
        if (isset($data['regions'])) {

            $regions = $data['regions'];
            $newRegions = [];

            foreach ($regions as $id => $region) {

                if (Region::find($region)) {
                    $newRegions[$id] = $region;
                } else {
                    $newRegion = Region::firstOrCreate(['title' => $region]);
                    $newRegions[$id] = $newRegion->id;
                };
            }

            $route->regions()->sync($newRegions);
        }

        foreach ($data['days'] as $key => $day) {
            $day['number'] = $key++;

            $transformedArray = collect($day['location'])
                ->zip($day['description'], $day['image'], $day['video'], $day['location_title'], $day['description_lv'], $day['location_title_lv'], $day['location_lv'])
                ->map(function ($item) {
                    return [
                        'location' => $item[0],
                        'description' => $item[1],
                        'image' => $item[2],
                        'video' => $item[3],
                        'location_title' => $item[4],
                        'description_lv' => $item[5],
                        'location_title_lv' => $item[6],
                        'location_lv' => $item[7],
                    ];
                })
                ->toArray();

            $day = $route->days()->create($day);

            foreach ($transformedArray as $key => $location) {
                $description = $location['description'];
                $location['description'] = "";
                if ($description) {
                    libxml_use_internal_errors(true);
                    $dom = new DOMDocument();
                    $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

                    $images = $dom->getElementsByTagName('img');

                    foreach ($images as $key => $img) {
                        $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);

                        $image_name = $day['number'] . '_' . time() . $key . '.png';
                        Storage::disk('public')->put("days/$route->id/{$day['number']}/locations/$key" . '/' . $image_name, $data);

                        $img->removeAttribute('src');
                        $img->setAttribute('src', "https://latvian-stories.smartnwild.com/storage/" . "days/$route->id/{$day['number']}/locations/$key" . '/' . $image_name);
                    }

                    $description = $dom->saveHTML();
                    $location['description'] = $description;
                }

                $descriptionLv = $location['description_lv'];
                $location['description_lv'] = "";
                if ($descriptionLv) {
                    libxml_use_internal_errors(true);
                    $dom = new DOMDocument();
                    $dom->loadHTML(mb_convert_encoding($descriptionLv, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

                    $images = $dom->getElementsByTagName('img');

                    foreach ($images as $key => $img) {
                        $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);

                        $image_name = $day['number'] . '_' . time() . $key . '.png';
                        Storage::disk('public')->put("days/$route->id/{$day['number']}/locations/$key/lv" . '/' . $image_name, $data);

                        $img->removeAttribute('src');
                        $img->setAttribute('src', "https://latvian-stories.smartnwild.com/storage/" . "days/$route->id/{$day['number']}/locations/$key/lv" . '/' . $image_name);
                    }

                    $descriptionLv = $dom->saveHTML();
                    $location['description_lv'] = $descriptionLv;
                }


                if ($location['video']) {
                    $video = $location['video'];
                    $imageName = time() . "_" . $video->getClientOriginalName(); // оригинальное имя файла
                    $directory = "days/$route->id/videos";
                    $videoPath = $video->storeAs($directory, $imageName, 'public');
                    $url_video = Storage::url($videoPath);
                    $location['url_video'] = $url_video;
                }

                if ($location['image']) {
                    $image = $location['image'];
                    $imageName = time() . "_" . $image->getClientOriginalName(); // оригинальное имя файла
                    $directory = "days/$route->id/images";
                    $imagePath = $image->storeAs($directory, $imageName, 'public');
                    $url_image = Storage::url($imagePath);
                    $location['url_image'] = $url_image;
                }
                $day->locations()->create($location);
            }
        }


        Session::flash('success', 'Route created successfully.');
        return redirect()->route('routes.index');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Route $route)
    // {
    //     return view('admin.routes.show', compact('route'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {

        return view('admin.routes.edit', [
            'categories' => Category::all(),
            'availabilities' => Availability::all(),
            'regions' => Region::all(),
            'route' => $route,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRouteRequest $request, Route $route)
    {
        // dd($request->days);
        $data = $request->validated();

        Storage::disk('public')->delete(str_replace('/storage', '', $route->url_image));

        $route->update($data);


        $image = $data['url_image'];
        $imageName = time() . "_" . $image->getClientOriginalName(); // оригинальное имя файла
        $directory = "routes/$route->id/image";
        $imagePath = $image->storeAs($directory, $imageName, 'public');
        $url_image = Storage::url($imagePath);
        $route['url_image'] = $url_image;
        $route->save();

        if (isset($data['categories'])) {
            $categories = $data['categories'];
            $newCategories = [];

            foreach ($categories as $id => $category) {
                if (Category::find($category)) {
                    $newCategories[$id] = $category;
                } else {
                    $newCategory = Category::firstOrCreate(['title' => $category]);
                    $newCategories[$id] = $newCategory->id;
                }
            }

            $route->categories()->sync($newCategories);
        }

        if (isset($data['availability'])) {
            $availabilities = $data['availability'];
            $newAvailabilities = [];

            foreach ($availabilities as $id => $availability) {
                if (Availability::find($availability)) {
                    $newAvailabilities[$id] = $availability;
                } else {
                    $newAvailability = Availability::firstOrCreate(['title' => $availability]);
                    $newAvailabilities[$id] = $newAvailability->id;
                }
            }

            $route->availabilities()->sync($newAvailabilities);
        }
        if (isset($data['regions'])) {

            $regions = $data['regions'];
            $newRegions = [];

            foreach ($regions as $id => $region) {

                if (Region::find($region)) {
                    $newRegions[$id] = $region;
                } else {
                    $newRegion = Region::firstOrCreate(['title' => $region]);
                    $newRegions[$id] = $newRegion->id;
                };
            }

            $route->regions()->sync($newRegions);
        }


        foreach ($route->days as $day) {
            foreach ($day->locations as $key => $location) {
                Storage::disk('public')->delete(str_replace('/storage', '', $location->url_image));
                Storage::disk('public')->delete(str_replace('/storage', '', $location->url_video));
                $location->delete();
            }
        }


        foreach ($data['days'] as $key => $day) {
            $day['number'] = $key++;


            $transformedArray = collect($day['location'])
                ->zip($day['description'], $day['image'], $day['video'], $day['location_title'], $day['description_lv'], $day['location_title_lv'], $day['location_lv'])
                ->map(function ($item) {
                    return [
                        'location' => $item[0],
                        'description' => $item[1],
                        'image' => $item[2],
                        'video' => $item[3],
                        'location_title' => $item[4],
                        'description_lv' => $item[5],
                        'location_title_lv' => $item[6],
                        'location_lv' => $item[7],
                    ];
                })
                ->toArray();
            // dd($transformedArray);

            $day = $route->days()->updateOrCreate(['number' => $day['number']], $day);


            foreach ($transformedArray as $key => $location) {

                $oldImagesDir = "/storage/days/$route->id/{$day['number']}/locations/$key/";


                $oldImagesInDir = [];
                $dirPath = public_path($oldImagesDir);

                if (is_dir($dirPath)) {
                    if ($dir = opendir($dirPath)) {
                        while (($file = readdir($dir)) !== false) {
                            if ($file != '.' && $file != '..') {
                                $oldImagesInDir[] = $oldImagesDir . $file;
                            }
                        }
                        closedir($dir);
                    }
                }


                $description = $location['description'];
                $location['description'] = "";
                if ($description) {
                    libxml_use_internal_errors(true);
                    $dom = new DOMDocument();
                    $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

                    $images = $dom->getElementsByTagName('img');
                    $oldImages = [];

                    foreach ($images as $key => $img) {
                        $src = $img->getAttribute('src');

                        // Проверяем, есть ли у изображения атрибут "src" и содержит ли он "base64,"
                        if ($src && strpos($src, 'base64,') !== false) {
                            $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);

                            $image_name = $day['number'] . '_' . time() . $key . '.png';
                            Storage::disk('public')->put("days/$route->id/{$day['number']}/locations/$key" . '/' . $image_name, $data);
                            $newSrc = Storage::url("days/$route->id/{$day['number']}/locations/$key" . '/' . $image_name);

                            $img->removeAttribute('src');
                            $img->setAttribute('src', "https://latvian-stories.smartnwild.com/storage/" . "days/$route->id/{$day['number']}/locations/$key" . '/' . $image_name);
                            $oldImages[] = $newSrc;
                        } else {
                            $oldSrc = $img->getAttribute('src');
                            if ($oldSrc) {
                                $oldImages[] = $oldSrc;
                            }
                        }
                    }
                    $oldImagesToRemove = array_diff($oldImagesInDir, $oldImages);
                    foreach ($oldImagesToRemove as $image) {
                        Storage::disk('public')->delete(str_replace('/storage', '', $image));
                    }

                    $description = $dom->saveHTML();
                    $location['description'] = $description;
                }

                $oldImagesDir = "/storage/days/$route->id/{$day['number']}/locations/$key/lv";

                $oldImagesInDir = [];
                $dirPath = public_path($oldImagesDir);

                if (is_dir($dirPath)) {
                    if ($dir = opendir($dirPath)) {
                        while (($file = readdir($dir)) !== false) {
                            if ($file != '.' && $file != '..') {
                                $oldImagesInDir[] = $oldImagesDir . $file;
                            }
                        }
                        closedir($dir);
                    }
                }

                $descriptionLv = $location['description_lv'];
                $location['description_lv'] = "";
                if ($descriptionLv) {
                    libxml_use_internal_errors(true);
                    $dom = new DOMDocument();
                    $dom->loadHTML(mb_convert_encoding($descriptionLv, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

                    $images = $dom->getElementsByTagName('img');
                    $oldImages = [];

                    foreach ($images as $key => $img) {
                        $src = $img->getAttribute('src');

                        // Проверяем, есть ли у изображения атрибут "src" и содержит ли он "base64,"
                        if ($src && strpos($src, 'base64,') !== false) {
                            $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);

                            $image_name = $day['number'] . '_' . time() . $key . '.png';
                            Storage::disk('public')->put("days/$route->id/{$day['number']}/locations/$key/lv" . '/' . $image_name, $data);
                            $newSrc = Storage::url("days/$route->id/{$day['number']}/locations/$key/lv" . '/' . $image_name);

                            $img->removeAttribute('src');
                            $img->setAttribute('src', "https://latvian-stories.smartnwild.com/storage/" . "days/$route->id/{$day['number']}/locations/$key/lv" . '/' . $image_name);
                            $oldImages[] = $newSrc;
                        } else {
                            $oldSrc = $img->getAttribute('src');
                            if ($oldSrc) {
                                $oldImages[] = $oldSrc;
                            }
                        }
                    }
                    $oldImagesToRemove = array_diff($oldImagesInDir, $oldImages);
                    foreach ($oldImagesToRemove as $image) {
                        Storage::disk('public')->delete(str_replace('/storage', '', $image));
                    }

                    $descriptionLv = $dom->saveHTML();
                    $location['description_lv'] = $descriptionLv;
                }

                if ($location['video']) {
                    $video = $location['video'];
                    $imageName = time() . "_" . $video->getClientOriginalName(); // оригинальное имя файла
                    $directory = "days/$route->id/videos";
                    $videoPath = $video->storeAs($directory, $imageName, 'public');
                    $url_video = Storage::url($videoPath);
                    $location['url_video'] = $url_video;
                    unset($location['video']);
                }

                if ($location['image']) {
                    $image = $location['image'];
                    $imageName = time() . "_" . $image->getClientOriginalName(); // оригинальное имя файла
                    $directory = "days/$route->id/images";
                    $imagePath = $image->storeAs($directory, $imageName, 'public');
                    $url_image = Storage::url($imagePath);
                    $location['url_image'] = $url_image;
                    unset($location['image']);
                }



                $day->locations()->updateOrCreate($location);
            }
        }
        Session::flash('success', 'Route changed successfully.');
        return redirect()->route('routes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        // dd($route);
        Storage::disk('public')->deleteDirectory("routes/$route->id");
        Storage::disk('public')->deleteDirectory("days/$route->id");
        $route->delete();
        Session::flash('success', 'Route deleted successfully.');
        return redirect()->route('routes.index');
    }
}
