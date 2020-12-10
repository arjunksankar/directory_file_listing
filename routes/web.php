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

Route::get('{slug?}', 'App\Http\Controllers\FileController@index')->name('list_files');
Route::post('file/post', 'App\Http\Controllers\FileController@store')->name('post_file');
Route::get('file/{file}/destroy', 'App\Http\Controllers\FileController@destroy')->name('delete_file');
