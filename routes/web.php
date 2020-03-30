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
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/add', 'HomeController@add')->name('home');
    Route::get('/user', 'HomeController@filter_user')->name('home');
    Route::get('/data_date', 'HomeController@filter_date')->name('home');
    Route::get('/next', 'HomeController@next_date')->name('home');
});
