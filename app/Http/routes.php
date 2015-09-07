<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'ReaderController@index');
Route::get('/items.json', 'ReaderController@jsonFeed');
Route::post('/items/delete', 'ReaderController@deleteItem');
Route::post('/items/viewed', 'ReaderController@viewedItem');
