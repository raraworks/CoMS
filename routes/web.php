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
Route::post('/projects/{project}', [
  'uses' => 'Project_taskController@store',
  'as' => 'task.store',
  'middleware' => 'auth'
]);

Route::post('/admin/users', [
    'uses' => 'UserController@store',
    'as' => 'user.store',
    'middleware' => 'admin'
]);
Route::put('/admin/users', [
    'uses' => 'UserController@update',
    'as' => 'user.update',
    'middleware' => 'admin'
]);
Route::get('/contacts/search', [
  'uses' => 'ContactController@search',
  'as' => "contacts.search"
]);
Route::get('/admin/search', [
  'uses' => 'PagesController@adminSearch',
  'as' => 'admin.search',
  'middleware' => 'admin'
  ]);
Route::delete('/admin/users/{id}', [
    'uses' => 'UserController@destroy',
    'as' => 'user.destroy',
    'middleware' => 'admin'
]);
Route::delete('/projects/{project}/task/{task_id}', [
    'uses' => 'Project_taskController@destroy',
    'as' => 'task.destroy'
]);
Route::post('/projects/{project}/addAttach', 'ProjectController@attachmentAdd')->name('projects.attach');
Route::get('/actionAttach/{filename}', 'FileController@getActionFile')->name('files.action');
Route::get('/sectionAttach/{filename}', 'FileController@getSectionFile')->name('files.section');
Route::delete('/sectionAttach/{filename}/delete', 'FileController@destroySectionFile')->name('files.section.destroy');
Route::get('/projectAttach/{filename}', 'FileController@getProjectFile')->name('files.project');
Route::delete('/projectAttach/{filename}/delete', 'FileController@destroyProjectFile')->name('files.project.destroy');
Route::get('/', 'PagesController@getIndex');
Route::resource('clients', 'ClientController');
Route::resource('actions', "ActionController");
Route::resource('contacts', "ContactController");
Route::resource('projects', "ProjectController");
Route::get('clients/{client}/section/create', 'SectionController@create')->name('sections.create');
Route::post('clients/{client}', 'SectionController@store')->name('sections.store');
Route::get('clients/{client}/section/{id}/edit', 'SectionController@edit')->name('sections.edit');
Route::put('clients/{client}/section', 'SectionController@update')->name('sections.update');
Route::delete('clients/{client}/section/{id}', 'SectionController@destroy')->name('sections.destroy');
// Route::get('/login', ['uses' => 'Auth/LoginController'])->middleware->('web')
Route::get('/search', 'ClientController@search')->name('clients.search');
Route::get('/map', 'PagesController@getMap');
Route::get('/home', 'HomeController@index');
Route::get('/admin', [
  'uses' => 'PagesController@adminPanel',
  'as' => 'admin.panel',
  'middleware' => 'admin'
  ]);


Auth::routes();
