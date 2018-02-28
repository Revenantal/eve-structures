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

// Auth Routing
Route::group(['prefix' => 'auth'], function(){
    Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    Route::get('/callback', ['as' => 'callback', 'uses' => 'Auth\LoginController@callback']);
    Route::post('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
});

Route::get('/home', 'HomeController@index')->name('home');
