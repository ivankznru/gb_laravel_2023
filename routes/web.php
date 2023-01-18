<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\News\CategoriesController;
use App\Http\Controllers\News\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/auth', [HomeController::class, 'auth'])->name('auth');
Route::post('/auth', [HomeController::class, 'auth'])->name('auth');
Route::get('/add-news-item', [HomeController::class, 'addNewsItem'])->name('add-news-item');
Route::post('/add-news-item', [HomeController::class, 'addNewsItem'])->name('add-news-item');

Route::name('news.')
    ->prefix('news')
    ->group(function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('index');
        Route::get('/categories/{slug}', [NewsController::class, 'listCategory'])->name('category');
        Route::get('/articles/{slug}', [NewsController::class, 'show'])->name('detail');
    });
