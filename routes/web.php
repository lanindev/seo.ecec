<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CasesController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\SeoController;
use App\Http\Controllers\Frontend\BlogController;

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

Route::get('/home', function () {
    return redirect()->route('home');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cases', [CasesController::class, 'index'])->name('cases');
Route::get('/case/{id}/{title?}', [CasesController::class, 'show'])->name('case');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}/{title?}', [NewsController::class, 'show'])->name('news_id');
Route::get('/seo', [SeoController::class, 'index'])->name('seo');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/category/{slug?}', [BlogController::class, 'category'])->name('blog_category');
Route::get('/blog/{id}/{title?}', [BlogController::class, 'show'])->name('blog_id');

//Route::view('/about', 'frontend.about')->name('about');
//Route::view('/property', 'frontend.property')->name('property');
//Route::view('/contact', 'frontend.about')->name('contact');
//Route::view('/privacy_policy', 'frontend.privacy_policy')->name('privacy_policy');
//Route::view('/terms', 'frontend.terms')->name('terms');

Route::get('/{slug}', [PageController::class, 'view'])->name('page.view');
