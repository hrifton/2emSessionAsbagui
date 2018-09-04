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
    return view('user.blogs');
});



Auth::routes();

Route::group(['middelware'=>'guest'],function(){

    Route::get('/home',function(){
        return view('home');
    })->name('home');
    Route::get('post',function(){
        return view('user.post');
    })->name('post');
});

Route::group(['namespace'=>'Admin'],function(){


    Route::resource('artiste','ArtisteController');
    Route::get('ApiArtiste','ArtisteController@ApiArtiste');
    Route::resource('type','TypeController');
    Route::resource('ArtisteType','Artiste_typeController');
//admin Auth Routes
    Route::get('admin-login','Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin-login','Auth\LoginController@login');



    Route::get('adminhome',function(){
        return view('admin.home');
    })->name('Adminhome');

});





