<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Blog_image;
use App\Models\Blog_video;
use App\Models\Route;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = Route::all();
        return view('admin.blogs.create', compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {

        // dd($request->all());
        $requestData = $request->validated();

        $files = $request->file('images');

        $blog = Blog::create([
            'title' => $requestData['title'],
            'title_lv' => $requestData['title_lv'],
            'description' => '',
            'description_lv' => '',
            'route_id' => $requestData['route_id'],
            'image' => '',
        ]);



        $image = $files[0];
        $extension = $image->getClientOriginalExtension();
        $filename = time() . "_" . $image->getClientOriginalName(); // оригинальное имя файла
        $directory = "blogs/$blog->id/images";
        $imagePath = $image->storeAs($directory, $filename, 'public');
        $url_image = Storage::url($imagePath);
        $blog->image = $url_image;

        $description = $requestData['description'];

        if ($description) {
            libxml_use_internal_errors(true);
            $dom = new DOMDocument();
            $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $key => $img) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);

                $image_name = $blog->id . '_' . time() . $key . '.png';
                Storage::disk('public')->put("blogs/$blog->id/description" . '/' . $image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', Storage::url("blogs/$blog->id/description" . '/' . $image_name));
            }

            $description = $dom->saveHTML();
            $blog['description'] = $description;
        }

        $descriptionLv = $requestData['description_lv'];

        if ($descriptionLv) {
            libxml_use_internal_errors(true);
            $dom = new DOMDocument();
            $dom->loadHTML(mb_convert_encoding($descriptionLv, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $key => $img) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);

                $image_name = $blog->id . '_' . time() . $key . '.png';
                Storage::disk('public')->put("blogs/$blog->id/descriptionLv" . '/' . $image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', Storage::url("blogs/$blog->id/descriptionLv" . '/' . $image_name));
            }

            $descriptionLv = $dom->saveHTML();
            $blog['description_lv'] = $descriptionLv;
        }




        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "_" .  $file->getClientOriginalName();
            $directory = "blogs/{$blog->id}/images";
            $imagePath = $file->storeAs($directory, $filename, 'public');
            $url_image = Storage::url($imagePath);
            $blog->images()->create(['url' => $url_image, 'blog_id' => $blog->id]);
        }

        $videoFiles = $request->file('videos');
        foreach ($videoFiles as $file) {
            $extension = $file->getClientOriginalExtension();
            if ($extension === 'mp4' || $extension === 'webm' || $extension === 'ogg') {
                $filename = time() . "_" .  $file->getClientOriginalName();
                $directory = "blogs/{$blog->id}/videos";
                $imagePath = $file->storeAs($directory, $filename, 'public');
                $url_image = Storage::url($imagePath);
                $blog->videos()->create(['url' => $url_image, 'blog_id' => $blog->id]);
            }
        }

        foreach ($requestData['story'] as $key => $story) {
            $video = $story['video'];
            $imageName = time() . "_" . $video->getClientOriginalName(); // оригинальное имя файла
            $extension = $video->getClientOriginalExtension();

            $directory = "blogs/$blog->id/stories";
            $videoPath = $video->storeAs($directory, $imageName, 'public');
            $url_video = Storage::url($videoPath);
            if ($extension === 'mp4' || $extension === 'webm' || $extension === 'ogg') {
                $story['url_video'] = $url_video;
            } else {
                $story['url_image'] = $url_video;
            }

            $required_image = $story['required_image'];
            $required_imageName = time() . "_" .  $required_image->getClientOriginalName(); // оригинальное имя файла

            $directory = "blogs/$blog->id/stories";
            $required_imagePath = $required_image->storeAs($directory, $required_imageName, 'public');
            $required_image = Storage::url($required_imagePath);
            $story['required_image'] = $required_image;


            $story['blog_id'] = $blog->id;
            $blog->stories()->create($story);
        }
        $blog->save();
        Session::flash('success', 'Blog created successfully.');
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Blog $blog)
    // {
    //     return view('admin.blogs.show', compact('blog'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $article)
    {
        $routes = Route::all();
        $blog = $article;

        return view('admin.blogs.edit', compact('blog', 'routes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $article)
    {
        // dd($request->all());
        $blog = $article;

        $requestData = $request->validated();

        foreach ($blog->images as $image) {
            Storage::disk('public')->delete(str_replace('/storage', '', $image->url));
            $image->delete();
        }

        foreach ($blog->videos as $video) {
            Storage::disk('public')->delete(str_replace('/storage', '', $video->url));
            $video->delete();
        }



        $files = $request->file('images');
        $image = $files[0];
        $filename = time() . "_" .  $image->getClientOriginalName();
        $directory = "blogs/{$blog->id}/images";
        $imagePath = $image->storeAs($directory, $filename, 'public');
        $url_image = Storage::url($imagePath);
        $requestData['image'] = $url_image;

        // $img_path = Storage::put("blogs/$blog->id/images", $files[0]);


        $oldImagesDir = "/storage/blogs/$blog->id/description/";

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

        $description = $requestData['description'];
        $requestData['description'] = "";
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

                    $image_name = $blog->id . '_' . time() . $key . '.png';
                    Storage::disk('public')->put("blogs/$blog->id/description" . '/' . $image_name, $data);
                    $newSrc = Storage::url("blogs/$blog->id/description" . '/' . $image_name);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', Storage::url("blogs/$blog->id/description" . '/' . $image_name));
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
            $requestData['description'] = $description;
        }

        $oldImagesDir = "/storage/blogs/$blog->id/descriptionLv/";

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

        $descriptionLv = $requestData['description_lv'];
        $requestData['description_lv'] = "";
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

                    $image_name = $blog->id . '_' . time() . $key . '.png';
                    Storage::disk('public')->put("blogs/$blog->id/descriptionLv" . '/' . $image_name, $data);
                    $newSrc = Storage::url("blogs/$blog->id/descriptionLv" . '/' . $image_name);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', Storage::url("blogs/$blog->id/descriptionLv" . '/' . $image_name));
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
            $requestData['description_lv'] = $descriptionLv;
        }


        $blog->update($requestData);


        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "_" .  $file->getClientOriginalName();
            $directory = "blogs/{$blog->id}/images";
            $imagePath = $file->storeAs($directory, $filename, 'public');
            $url_image = Storage::url($imagePath);
            $blog->images()->create(['url' => $url_image, 'blog_id' => $blog->id]);
        }

        $videoFiles = $request->file('videos');
        foreach ($videoFiles as $file) {
            $extension = $file->getClientOriginalExtension();
            if ($extension === 'mp4' || $extension === 'webm' || $extension === 'ogg') {
                $filename = time() . "_" .  $file->getClientOriginalName();
                $directory = "blogs/{$blog->id}/videos";
                $imagePath = $file->storeAs($directory, $filename, 'public');
                $url_image = Storage::url($imagePath);
                $blog->videos()->create(['url' => $url_image, 'blog_id' => $blog->id]);
            }
        }


        foreach ($blog->stories as $key => $story) {
            Storage::disk('public')->delete(str_replace('/storage', '', $story->url_video));
            Storage::disk('public')->delete(str_replace('/storage', '', $story->url_image));
            Storage::disk('public')->delete(str_replace('/storage', '', $story->required_image));
            $story->delete();
        }

        foreach ($requestData['story'] as $key => $story) {
            $video = $story['video'];
            $imageName = time() . "_" .  $video->getClientOriginalName();
            $extension = $video->getClientOriginalExtension();

            $directory = "blogs/{$blog->id}/stories";
            $videoPath = $video->storeAs($directory, $imageName, 'public');
            $url_video = Storage::url($videoPath);


            if ($extension === 'mp4' || $extension === 'webm' || $extension === 'ogg') {
                $story['url_video'] = $url_video;
            } else {
                $story['url_image'] = $url_video;
            }

            $required_image = $story['required_image'];
            $required_imageName = time() . "_" .  $required_image->getClientOriginalName(); // оригинальное имя файла

            $directory = "blogs/$blog->id/stories";
            $required_imagePath = $required_image->storeAs($directory, $required_imageName, 'public');
            $required_image = Storage::url($required_imagePath);
            $story['required_image'] = $required_image;

            $story['blog_id'] = $blog->id;
            $blog->stories()->create($story);
        }

        Session::flash('success', 'Blog changed successfully.');
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $article)
    {
        $blog = $article;


        Storage::disk('public')->deleteDirectory("blogs/$blog->id");


        $blog->delete();
        Session::flash('success', 'Blog successfully deleted.');
        return redirect()->route('articles.index');
    }
}
