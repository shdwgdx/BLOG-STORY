<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Route;
use App\Models\Story;
use App\Models\Category;
use App\Models\Region;
use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SiteController extends Controller
{
    public function filter(Request $request)
    {
        $searchTerm = $request->input('query');

        $blogs = Blog::where('title', 'LIKE', "%$searchTerm%")
            ->orWhereHas('route', function ($query) use ($searchTerm) {
                $query->where('description', 'LIKE', "%$searchTerm%");
            })
            ->get();

        if (empty($searchTerm)) {
            return response()->json([]);
        }
        return response()->json($blogs);
    }
    function storySearch(Request $request)
    {
        $searchTerm = $request->input('query');

        $stories = Story::where('title', 'LIKE', "%$searchTerm%")
            ->orWhere('description', 'LIKE', "%$searchTerm%")
            ->get();

        if (empty($searchTerm)) {
            return response()->json([]);
        }
        return response()->json($stories);
    }
    public function search(Request $request)
    {
        $categoryIds = explode(',', $request->input('categories', ''));
        $availabilityIds = explode(',', $request->input('availabilities', ''));
        $regionIds = explode(',', $request->input('regions', ''));
        $searchTerm = $request->input('query');

        $categoryIdsArray = Category::where('title', 'like', '%' . $searchTerm . '%')
            ->pluck('id')
            ->toArray();
        $availabilityIdsArray = Availability::where('title', 'like', '%' . $searchTerm . '%')
            ->pluck('id')
            ->toArray();
        $regionIdsArray = Region::where('title', 'like', '%' . $searchTerm . '%')
            ->pluck('id')
            ->toArray();


        $blogs = Blog::with(['route', 'route.categories', 'route.availabilities', 'route.regions'])
            ->when(!empty($searchTerm), function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('route', function ($query) use ($searchTerm) {
                        $query->where('description', 'like', '%' . $searchTerm . '%');
                    });
            })
            ->when(!empty($request->categories), function ($query) use ($categoryIds) {
                $query->whereHas('route.categories', function ($query) use ($categoryIds) {
                    $query->whereIn('category_id', $categoryIds);
                });
            })
            ->when(!empty($request->availabilities), function ($query) use ($availabilityIds) {
                $query->whereHas('route.availabilities', function ($query) use ($availabilityIds) {
                    $query->whereIn('availability_id', $availabilityIds);
                });
            })
            ->when(!empty($request->regions), function ($query) use ($regionIds) {
                $query->whereHas('route.regions', function ($query) use ($regionIds) {
                    $query->whereIn('region_id', $regionIds);
                });
            })
            ->select('blogs.*')
            ->distinct()
            ->get();
        // dd($blogs);
        // dd($blogs->isEmpty());
        // dd($categoryIdsArray, $availabilityIdsArray, $regionIdsArray);
        if ($blogs->isEmpty()) {
            if (empty($categoryIdsArray) && empty($availabilityIdsArray) && empty($regionIdsArray)) {
                $blogs = collect();
            } else {
                $blogs = Blog::with(['route', 'route.categories', 'route.availabilities', 'route.regions'])
                    ->when(!empty($categoryIdsArray), function ($query) use ($categoryIdsArray) {
                        $query->whereHas('route.categories', function ($query) use ($categoryIdsArray) {
                            $query->whereIn('category_id', $categoryIdsArray);
                        });
                    })
                    ->when(!empty($availabilityIdsArray), function ($query) use ($availabilityIdsArray) {
                        $query->whereHas('route.availabilities', function ($query) use ($availabilityIdsArray) {
                            $query->whereIn('category_id', $availabilityIdsArray);
                        });
                    })
                    ->when(!empty($regionIdsArray), function ($query) use ($regionIdsArray) {
                        $query->whereHas('route.regions', function ($query) use ($regionIdsArray) {
                            $query->whereIn('region_id', $regionIdsArray);
                        });
                    })
                    ->when(!empty($request->categories), function ($query) use ($categoryIds) {
                        $query->whereHas('route.categories', function ($query) use ($categoryIds) {
                            $query->whereIn('category_id', $categoryIds);
                        });
                    })
                    ->when(!empty($request->availabilities), function ($query) use ($availabilityIds) {
                        $query->whereHas('route.availabilities', function ($query) use ($availabilityIds) {
                            $query->whereIn('availability_id', $availabilityIds);
                        });
                    })
                    ->when(!empty($request->regions), function ($query) use ($regionIds) {
                        $query->whereHas('route.regions', function ($query) use ($regionIds) {
                            $query->whereIn('region_id', $regionIds);
                        });
                    })
                    ->select('blogs.*')
                    ->distinct()
                    ->get();
            }
        }


        return response()->json($blogs);
    }
    public function adminSearch(Request $request)
    {
        $searchTerm = $request->input('title');

        $blogs = Blog::where('title', 'LIKE', "%$searchTerm%")->get();

        if (empty($searchTerm)) {
            return response()->json([]);
        }
        return response()->json($blogs);
    }
}
