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
    Route::post(
        '/store',
        [
            'as' => "categories.store", // tên định dang tên link
            'uses' => "CategoryController@store", // Sử dung controller
        ]
    );
    Route::get(
        '/edit/{id}',
        [
            'as' => "categories.edit", // tên định dang tên link
            'uses' => "CategoryController@edit", // Sử dung controller
        ]
    );
    Route::get(
        '/delete/{id}',
        [
            'as' => "categories.delete", // tên định dang tên link
            'uses' => "CategoryController@delete", // Sử dung controller
        ]
    );
    Route::post(
        '/update/{id}',
        [
            'as' => "categories.update", // tên định dang tên link
            'uses' => "CategoryController@update", // Sử dung controller
        ]
    );
});

Route::prefix('menus')->group(function () {
    Route::get('/', [
        'as' => 'menus.index',
        'uses' => 'MenuController@index'
    ]);
    Route::get('/create', [
        'as' => 'menus.create',
        'uses' => 'MenuController@create'
    ]);
    Route::post('/store', [
        'as' => 'menus.store',
        'uses' => 'MenuController@store'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'menus.edit',
        'uses' => 'MenuController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'menus.delete',
        'uses' => 'MenuController@delete'
    ]);
    Route::post('/update/{id}', [
        'as' => 'menus.update',
        'uses' => 'MenuController@update'
    ]);
});
