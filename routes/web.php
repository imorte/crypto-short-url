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

Route::post('/generate', 'UrlController@hash');
Route::get('{short}', 'UrlController@redirect')
    ->where('short', '[A-Za-z0-9]{4,6}+')
    ->middleware('premium');