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

Route::post('todo/store', 'TodosController@store')->name('todo.store');
Route::get('todo/{id}/edit', 'TodosController@edit')->name('todo.edit');
Route::put('todo/{id}/update', 'TodosController@update')->name('todo.update');
Route::delete('todo/{id}/delete', 'TodosController@delete')->name('todo.delete');


