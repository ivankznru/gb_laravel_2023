<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\News\CategoriesController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\RequestInfoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoriesController as AdminCategoriesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;

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

Route::match(['get', 'post'], '/profile', [ProfileController::class, 'update'])->name('updateProfile');

Route::name('news.')
    ->prefix('news')
    ->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('index');
        Route::get('/{slug}', [NewsController::class, 'show'])->name('detail');
    });
Route::name('categories.')
    ->prefix('categories')
    ->group(function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('index');
        Route::get('/{slug}', [CategoriesController::class, 'show'])->name('detail');
    });

Route::name('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('/', [AdminIndexController::class, 'index'])->name('index');

        Route::resource('/news', AdminNewsController::class)->except(['show']);
        Route::resource('/categories', AdminCategoriesController::class)->except(['show']);

        Route::resource('/users', AdminUsersController::class)->except(['show']);
    });

Route::name('comments.')
    ->prefix('comments')
    ->group(function () {
        Route::get('/', [CommentsController::class, 'index'])->name('index');
        //CRUD
        Route::match(['get', 'post'], '/create', [CommentsController::class, 'create'])->name('create');
        Route::get('/edit/{comments}', [CommentsController::class, 'edit'])->name('edit');
        Route::post('/update/{comments}', [CommentsController::class, 'update'])->name('update');
        Route::delete('/delete/{comments}', [CommentsController::class, 'delete'])->name('delete');
    });


Route::name('requestInfo.')
    ->prefix('requestInfo')
    ->group(function () {
        Route::get('/', [RequestInfoController::class, 'index'])->name('index');
        //CRUD
        Route::match(['get', 'post'], '/create', [RequestInfoController::class, 'create'])->name('create');
        Route::get('/edit/{requestInfo}', [RequestInfoController::class, 'edit'])->name('edit');
        Route::post('/update/{requestInfo}', [RequestInfoController::class, 'update'])->name('update');
        Route::delete('/delete/{requestInfo}', [RequestInfoController::class, 'delete'])->name('delete');
    });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
