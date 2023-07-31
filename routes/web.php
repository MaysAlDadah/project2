<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
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

Route::get('/about', function(){
    return view('about');
})->name('about');

Route::get('/', function () {
    // if you don’t put with() here, you will have N+1 query performance problem
    $articles  = Article::with('category', 'tags')->take(3)->latest()->get();

    return view('pages.home', compact('articles'));
})->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/articles/create', [App\Http\Controllers\Admin\ArticleController::class, 'create'])->name('admin.articles.create');
Route::post('admin/articles', [App\Http\Controllers\Admin\ArticleController::class, 'store'])->name('admin.articles.store');
Route::get('admin/articles/{article}', [App\Http\Controllers\Admin\ArticleController::class, 'show'])->name('admin.articles.show');

Route::view('about', 'pages.about')->name('about');

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('tags', App\Http\Controllers\Admin\TagController::class);
    Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class);
});

Auth::routes();