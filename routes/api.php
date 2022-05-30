<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\ArticleController;
use App\Http\Controllers\API\V1\CategorieController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::group(['middleware' => 'auth:api'], function(){
            Route::get('logout','logout');
        });
    });
    
    Route::middleware('auth:api')->group(function() {
        Route::controller(ArticleController::class)->group(function(){
            Route::get('articles', 'index');
            Route::get('articles/{id}', 'show');
            Route::post('articles/store', 'store');
            Route::post('articles/update/{id}', 'update');
            Route::delete('articles/delete/{id}', 'destroy');
        });

        Route::controller(CategorieController::class)->group(function(){
            Route::get('categories', 'index');
            Route::post('categories/store', 'store');
            Route::post('categories/update/{id}', 'update');
            Route::delete('categories/delete/{id}', 'destroy');
        });
    });
});


