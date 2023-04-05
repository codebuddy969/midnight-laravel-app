<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->controller(PostController::class)->group(function(){

    Route::get('posts', 'index')->name('posts.index');

    Route::post('posts', 'store')->name('posts.store');

    Route::get('posts/create', 'create')->name('posts.create');

    Route::get('posts/{post}', 'show')->name('posts.show');

    Route::put('posts/{post}', 'update')->name('posts.update');

    Route::delete('posts', 'destroy')->name('posts.destroy');

    Route::get('posts/{post}/edit', 'edit')->name('posts.edit');
});


Route::middleware('auth:sanctum')->controller(UserController::class)->group(function(){

    Route::get('users', 'index')->name('users.index');

    Route::post('users', 'store')->name('users.store');

    Route::get('users/create', 'create')->name('users.create');

    Route::get('users/{user}', 'show')->name('users.show');

    Route::put('users/{user}', 'update')->name('users.update');

    Route::delete('users', 'destroy')->name('users.destroy');

    Route::get('users/{user}/edit', 'edit')->name('users.edit');
});