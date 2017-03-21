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
Route::get('/contacts/search', [
  'uses' => 'ContactController@search',
  'as' => "contacts.search"
]);
Route::get('/admin/search', [
  'uses' => 'PagesController@adminSearch',
  'as' => 'admin.search',
  'middleware' => 'admin'
  ]);
Route::get('/', 'PagesController@getIndex');
Route::resource('clients', 'ClientController');
Route::resource('actions', "ActionController");
Route::resource('contacts', "ContactController");
Route::get('clients/{client}/section/create', 'SectionController@create')->name('sections.create');
Route::post('clients/{client}', 'SectionController@store')->name('sections.store');
Route::get('clients/{client}/section/{id}/edit', 'SectionController@edit')->name('sections.edit');
Route::put('clients/{client}/section', 'SectionController@update')->name('sections.update');
Route::delete('clients/{client}/section/{id}', 'SectionController@destroy')->name('sections.destroy');
// Route::get('/login', ['uses' => 'Auth/LoginController'])->middleware->('web')
Route::get('/search', 'ClientController@search')->name('clients.search');
Route::get('/actionAttach/{filename}', 'FileController@getActionFile')->name('files.action');
Route::get('/sectionAttach/{filename}', 'FileController@getSectionFile')->name('files.section');
Route::delete('/sectionAttach/{filename}/delete', 'FileController@destroySectionFile')->name('files.section.destroy');
Route::get('/home', 'HomeController@index');
Route::get('/admin', [
  'uses' => 'PagesController@adminPanel',
  'as' => 'admin.panel',
  'middleware' => 'admin'
  ]);


Auth::routes();
