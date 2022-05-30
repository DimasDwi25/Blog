<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\WelcomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::controller(WelcomeController::class)->group(function() {
    Route::get('/','index')->name('welcome');
    Route::get('/articles/{id}', 'show')->name('welcome.article');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(ArticleController::class)->middleware('auth')->group(function() {
    Route::get('article', 'index')->name('article.index');
    Route::get('article/create', 'create')->name('article.create');
    Route::post('article/store', 'store')->name('article.store');
    Route::get('article/edit/{id}', 'edit')->name('article.edit');
    Route::post('article/update/{id}', 'update')->name('article.update');
});

Route::controller(CategorieController::class)->middleware('auth')->group(function () {
    Route::get('categorie', 'index')->name('categorie.index');
    Route::get('categorie/create', 'create')->name('categorie.create');
    Route::post('categorie/create/store', 'store')->name('categorie.store');
    Route::post('categorie/update/{id}', 'update')->name('categorie.update');
    Route::get('categorie/destroy/{id}', 'destroy')->name('categorie.destroy');
});


