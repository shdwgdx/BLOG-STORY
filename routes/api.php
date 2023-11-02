<?php

use App\Http\Controllers\Api\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('blogs/filter', [SiteController::class, 'filter']);
Route::get('blogs/search', [SiteController::class, 'search']);
Route::get('stories/search', [SiteController::class, 'storySearch']);
Route::get('admin/blogs/search', [SiteController::class, 'adminSearch']);
