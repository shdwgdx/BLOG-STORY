<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/blog/{blog}', [SiteController::class, 'blogItem'])->name('blog-item');
Route::get('/privacy-policy', [SiteController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms', [SiteController::class, 'cookies'])->name('cookies');
Route::get('/route/{route}', [SiteController::class, 'route'])->name('route');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
Route::get('/stories', [SiteController::class, 'stories'])->name('stories');
Route::get('/thanks', [SiteController::class, 'thanks'])->name('thanks');

Route::post('/send-route', [SiteController::class, 'sendRoute'])->name('sendRoute');
// Route::get('/articles', [SiteController::class, '']);

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('loginForm');
    Route::post('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout')->middleware(['auth']);
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard')->middleware(['auth']);
    Route::resource('routes', RouteController::class)->middleware(['auth']);
    Route::resource('articles', BlogController::class)->middleware(['auth']);
    Route::resource('users', UserController::class)->middleware(['auth']);
    Route::resource('partners', PartnerController::class)->middleware(['auth']);
    // Route::resource('users', UserController::class)->middleware(['auth']);

    // Route::get('/routes', [RouteController::class, 'routes'])->name('admin.route.index');
    // Route::get('/create-blog', [RouteController::class, 'create'])->name('admin.route.create');
    // Route::post('/create-blog', [RouteController::class, 'store'])->name('admin.route.store');
});

Route::fallback(function () {
    return view('404');
});
