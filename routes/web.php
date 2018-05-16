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
    return redirect('view');
});

Route::get('pictures', 'IndexController@index');
Route::get('view', 'IndexController@view');
Route::post('view', 'IndexController@add')->name('picture');
Route::get('delete/{id}/{file}/{ext}', 'IndexController@delete');
Route::get('up/{sort}', 'IndexController@sortUp');
Route::get('down/{sort}', 'IndexController@sortDown');
Route::get('getContent/{id?}', 'IndexController@getContent');
Route::post('pushContent', 'IndexController@pushContent');


Route::get('information', 'InformationController@information');
Route::post('add', 'InformationController@add');
Route::get('delete2/{id}/{file}/{ext}', 'InformationController@delete');
Route::get('getContent2/{id?}', 'InformationController@getContent');
Route::post('pushContent2', 'InformationController@pushContent');
Route::post('title', 'InformationController@title');
Route::get('trophy', 'InformationController@trophy');
Route::get('getTrophy', 'InformationController@getTrophy');
Route::post('setTrophy', 'InformationController@setTrophy');

Route::get('list', 'IndexController@informationList');