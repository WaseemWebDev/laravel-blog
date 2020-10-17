<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/createblog', 'BlogController@index')->name('createblog');
Route::post('/upload', 'BlogController@uploadblog');
Route::post('/delete', 'BlogController@deletepost');
Route::get('/readmore/{id}', 'BlogController@readmore');
Route::post('/comment', 'BlogController@addcomment');
Route::post('/search', 'BlogController@searchpost');
