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

Route::get('/', 'HomeController@index')->name('home');
Route::resource('/gallery', 'GalleryController');
Route::resource('/photo', 'PhotoController');

Route::get('/user/{name}', 'GalleryController@showUserGallery')
    ->name('user.gallery');

Auth::routes();
