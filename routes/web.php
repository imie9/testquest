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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/category/tree', 'CategoryApiController@categoryTree');
Route::get('/category/list', 'CategoryApiController@categoryList');
Route::post('/category/items-list', 'CategoryApiController@itemsList');
Route::post('/category/create', 'CategoryApiController@create');

Route::post('/item/create', 'ItemApiController@create');

Route::get('/item/image/{path}', 'ItemApiController@image');

Route::get('{path}', 'MainController@index')->where('path', '([A-z\d-\/_.]+)?');