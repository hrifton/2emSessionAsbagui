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
    return view('layouts.welcome');
});

Route::resource('artiste','ArtisteController');
Route::resource('artiste_type','Artiste_TypeController');
Route::resource('artiste_type_show','Artiste_Type_ShowController');
Route::resource('categorie','Categorie_ShowController');
Route::resource('localitie','LocalitieController');
Route::resource('location','LocationController');
Route::resource('representation','RepresentationController');
Route::resource('representation_user','Representation_UserController');
Route::resource('role','RoleController');
Route::resource('show','ShowController');
Route::resource('type','TypeController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

