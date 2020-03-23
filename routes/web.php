<?php

// Eloquent provides lifecyle trigger points in which one can
// call operations.  One such is lifecyle trigger is:
// created -- The model was created and saved... do something:
//Moved these trigger methods over to an observer class for Project
//php artisan make:observer ProjectObserver --model=Project


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

Route::group(['middleware' => 'auth'], function(){	
	// Route::get('/projects', 'ProjectsController@index');
	// Route::get('/projects/create', 'ProjectsController@create');
	// Route::get('/projects/{project}', 'ProjectsController@show');
	// Route::patch('/projects/{project}', 'ProjectsController@update');
	// Route::get('/projects/{project}/edit', 'ProjectsController@edit');
	// Route::post('/projects', 'ProjectsController@store');	
	// Route::delete('/projects/{project}', 'ProjectsController@destroy');	
	Route::resource('projects', 'ProjectsController');

	Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
	Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');	
});
Route::get('/', 'ProjectsController@index');

/* Respond to a project post request */

Auth::routes();


