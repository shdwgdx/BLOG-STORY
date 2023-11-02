<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Blog;
use App\Models\Blog_video;
use App\Models\Category;
use App\Models\Route;
use App\Models\UserRoute;
use App\Models\Story;
use App\Models\Region;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Part\HtmlPart;
use App\Mail\RouteMail;

class SiteController extends Controller
{
    function index()
    {
        $blogs = Blog::latest()->take(3)->get();
        $stories = Story::latest()->take(6)->get();
        $partners = Partner::all();
        // $partners = Partner::latest()->take(5)->get();

        return view('index', [
            'blogs' => $blogs,
            'stories' => $stories,
            'partners' => $partners,
        ]);
    }
    function blogItem(Blog $blog)
    {
        $blog_videos = Blog_video::where('blog_id', $blog->id)->first();
        return view('blog_item', ['blog' => $blog, 'blog_videos' => $blog_videos]);
    }

    function privacyPolicy()
    {
        return view('privacy-policy');
    }
    function cookies()
    {
        return view('cookies');
    }
    function blog()
    {
        $blogs = Blog::all();
        $availabilities = Availability::whereIn('id', function ($query) {
            $query->select('availability_id')
                ->from('availability_route')
                ->distinct();
        })->get();
        $categories = Category::whereIn('id', function ($query) {
            $query->select('category_id')
                ->from('category_route')
                ->distinct();
        })->get();
        $regions = Region::whereIn('id', function ($query) {
            $query->select('region_id')
                ->from('region_route')
                ->distinct();
        })->get();

        return view('blog', [
            'blogs' => $blogs,
            'categories' => $categories,
            'availabilities' => $availabilities,
            'regions' => $regions,
        ]);
    }
    function route(Route $route)
    {
        return view('route', [
            'route' => $route,
        ]);
    }
    function stories()
    {
        $stories = Story::all();
        return view(
            'stories',
            ['stories' => $stories]
        );
    }
    function thanks()
    {
        return view('thank-you');
    }

    function sendRoute(Request $request)
    {
        $email = $request->input('email');
        $route_id = $request->input('route_id');
        UserRoute::create($request->all());

        Mail::to($email)
            ->send(new RouteMail($route_id)); // Отправляем письмо с использованием модели мэйла

        return response()->json(['message' => 'Request processed successfully']);
    }
}
