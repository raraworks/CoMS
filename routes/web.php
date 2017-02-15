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

Route::get('/', 'PagesController@getIndex');
Route::resource('clients', 'ClientController');
Route::resource('actions', "ActionController");
Route::resource('contacts', "ContactController");
Route::get('clients/{client}/section/create', 'SectionController@create')->name('sections.create');
Route::post('clients/{client}', 'SectionController@store')->name('sections.store');
Route::get('clients/{client}/section/{id}/edit', 'SectionController@edit')->name('sections.edit');
Route::put('clients/{client}', 'SectionController@update')->name('sections.update');
Route::delete('clients/{client}/section/{id}', 'SectionController@destroy')->name('sections.destroy');
// Route::get('/login', ['uses' => 'Auth/LoginController'])->middleware->('web')
