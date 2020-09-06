<?php

use Illuminate\Support\Facades\Route;

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
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('/content', 'ContentController')->except(['edit', 'show', 'update']);
Route::get('/content/download', 'ContentController@download')->name('content.download');
Route::post('/content/download', 'ContentController@downloadReport')->name('content.report');

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/{slug}', 'HomeController@single')->name('home.single');
