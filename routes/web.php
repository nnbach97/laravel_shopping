<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::prefix('categories')->group(function () {
    Route::get(
        '/',
        [
            'as' => "categories.index", // tên định dang tên link
            'uses' => "CategoryController@index", // Sử dung controller
        ]

    );
    Route::get(
        '/create',
        [
            'as' => "categories.create", // tên định dang tên link
            'uses' => "CategoryController@create", // Sử dung controller
        ]

    );
});
