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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/nodetypes', 'NodeTypeController@index')->name('nodetypes.index');
Route::get('/nodetypes/create', 'NodeTypeController@create')->name('nodetypes.create');
Route::post('/nodetypes', 'NodeTypeController@store')->name('nodetypes.store');
Route::get('/nodetypes/{id}/edit', 'NodeTypeController@edit')->name('nodetypes.edit');

Route::get('/node/{id}', 'NodeController@index')->name('node.index');
