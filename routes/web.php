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
//ユーザーページのルート
Route::get('/', 'IndexController@index')->middleware('auth')->name('index');
Route::patch('flag/update', 'IndexController@update')->name('flag_update');
Route::delete('delete', 'IndexController@delete')->name('delete');
//お薬手帳ページのルート
Route::get('show', 'ShowController@show')->middleware('auth')->name('show');
//お薬手帳のお薬投稿の更新削除ルート
Route::get('show/post_edit/{post}', 'ShowController@post_edit')->name('post_edit');
Route::put('post/update', 'ShowController@post_update')->name('post_update');
Route::delete('post/delete', 'ShowController@post_delete')->name('post_delete');
//お薬手帳の画像登録の更新削除ルート
Route::get('show/photo_edit/{photo}', 'ShowController@photo_edit')->name('photo_edit');
Route::put('photo/update', 'ShowController@photo_update')->name('photo_update');
Route::delete('photo/delete', 'ShowController@photo_delete')->name('photo_delete');
//服用時間登録のルート
Route::resource('dosing', DosingController::class)->only([
    'create',
    'store'
]);
//お薬投稿のルート
Route::resource('post', PostController::class)->only([
    'create',
    'store'
]);
//画像登録のルート
Route::resource('photo', PhotoPostController::class)->only([
    'create',
    'store'
]);
//体重管理ページのルート
Route::resource('graph', WeightGraphController::class)->only([
    'index',
    'store'
]);
