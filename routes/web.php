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

Route::get('pictures', 'IndexController@index');
Route::get('view', 'IndexController@view');
Route::post('view', 'IndexController@add')->name('picture');
Route::get('delete/{id}/{file}', 'IndexController@delete');
Route::get('up/{sort}', 'IndexController@sortUp');
Route::get('down/{sort}', 'IndexController@sortDown');
Route::get('getContent', 'IndexController@getContent');
Route::post('pushContent', 'IndexController@pushContent');


Route::get('information', 'InformationController@information');
Route::post('add', 'InformationController@add');
Route::get('delete2/{id}/{file}', 'InformationController@delete');
Route::get('getContent2', 'InformationController@getContent');
Route::post('pushContent2', 'InformationController@pushContent');
Route::get('title', 'InformationController@title');

Route::get('list', 'IndexController@informationList');