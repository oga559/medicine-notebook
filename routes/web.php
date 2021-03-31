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

Auth::routes();
Route::get('/', 'IndexController@index')->middleware('auth')->name('index');
Route::get('update', 'IndexController@update')->name('update');
Route::get('delete', 'IndexController@delete')->name('delete');
Route::get('show', 'ShowController@show')->middleware('auth')->name('show');
Route::resource('post', PostController::class)->only([
    'create',
    'store'
]);
Route::resource('dosing', DosingController::class)->only([
    'create',
    'store'
]);
Route::resource('photo', PhotoPostController::class)->only([
    'create',
    'store'
]);

