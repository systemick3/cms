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

// Nodetypes
Route::middleware(['auth'])->prefix('nodetypes')->group(function () {
  Route::get('/', 'NodeTypeController@index')->name('nodetypes.index');
  Route::get('/create', 'NodeTypeController@create')->name('nodetypes.create');
  Route::post('/', 'NodeTypeController@store')->name('nodetypes.store');
  Route::get('/{id}/edit', 'NodeTypeController@edit')->name('nodetypes.edit');
});

// Nodes
Route::middleware(['auth'])->prefix('nodes')->group(function () {
  //Route::get('/nodes', 'NodeController@index')->name('nodes.index');
  Route::get('/list', 'NodeController@index')->name('nodes.list');
  Route::get('/create', 'NodeController@create')->name('nodes.create');
  //Route::post('/nodes', 'NodeController@store')->name('nodes.store');
  Route::post('/list', 'NodeController@store')->name('nodes.store');
  Route::get('/{id}/edit', 'NodeController@edit')->name('nodes.edit');
  //Route::get('/ckimage', 'NodeController@ckimage')->name('nodes.ckimage');
  Route::get('/{id}/status', 'NodeController@status')->name('nodes.status');
  Route::get('/{id}/delete', 'NodeController@delete')->name('nodes.delete');
  Route::get('/{id}/delete/confirmed', 'NodeController@deleteConfirmed')->name('nodes.delete_confirmed');
});
Route::get('/nodes/{id}', 'NodeController@show')->name('nodes.show');
Route::get('/c/{slug}', 'NodeController@slug')->name('nodes.slug');

// Blocks
Route::middleware(['auth'])->prefix('blocks')->group(function () {
  Route::get('/', 'BlockController@index')->name('blocks.index');
  Route::get('/create', 'BlockController@create')->name('blocks.create');
  Route::post('/', 'BlockController@store')->name('blocks.store');
  Route::get('/{id}/edit', 'BlockController@edit')->name('blocks.edit');
  Route::get('/{id}/status', 'BlockController@status')->name('blocks.status');
  Route::get('/{id}/delete', 'BlockController@delete')->name('blocks.delete');
  Route::get('/{id}/delete/confirmed', 'BlockController@deleteConfirmed')->name('blocks.delete_confirmed');
});
