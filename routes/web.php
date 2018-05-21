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


Route::get('index', 'IndexController@index');
Route::get('index/chart1','IndexController@chart1');
Route::get('index/chart2','IndexController@chart2');
Route::get('index/male','IndexController@male');
Route::get('index/female','IndexController@female');
Route::get('index/table','IndexController@table');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
