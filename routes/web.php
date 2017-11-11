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

Auth::routes();

Route::prefix('admin')->middleware('auth')->namespace('Back')->group(function () {

	//Index admin
	Route::name('admin')->get('/', 'AdminController@index');

	//CRUD Video
	Route::resource('videos', 'VideoController');

	//CRUD Auto
	Route::prefix('auto')->namespace('Auto')->group(function () {
		Route::name('auto.index')->get('{class}/index', 'AutoController@index');
		Route::name('auto.create')->get('{class}/edit', 'AutoController@create');
		Route::name('auto.edit')->get('{class}/edit/{id}', 'AutoController@edit');
		Route::name('auto.update')->post('{class}/update/{id}', 'AutoController@update');
		Route::name('auto.destroy')->get('{class}/destroy/{id}', 'AutoController@destroy');
	});	

});
