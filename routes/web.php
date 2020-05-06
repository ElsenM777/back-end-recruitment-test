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

Route::get('/', 'QueryController@index');
Route::get('/new-query','QueryController@new_query')->name('new-query');
Route::post('/new-query','QueryController@new_query_post')->name('new-query-post');
Route::get('/query/{id}','QueryController@query')->where('id', '[0-9]+');
Route::post('/query-save','QueryController@query_save');
Route::post('/query-result','QueryController@query_result');
Route::get('/query-save',function(){
    abort(404);
});
Route::get('/query-result',function(){
    abort(404);
});