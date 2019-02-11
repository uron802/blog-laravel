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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ArticleController@index')->name('article');
Route::get('/article/list', 'ArticleController@list')->name('article.list');
Route::get('/article/create', 'ArticleController@create')->name('article.create');
Route::get('/article/edit/{id}', 'ArticleController@edit')->name('article.edit');
Route::get('/article/show/{id}', 'ArticleController@show')->name('article.show');
Route::post('/article/store', 'ArticleController@store')->name('article.store');
Route::post('/article/update/{id}', 'ArticleController@update')->name('article.update');
Route::get('/article/delete/{id}', 'ArticleController@delete')->name('article.delete');

Route::post('/article/back/draft/{id}', 'ArticleController@backDraft')->name('article.back.draft');
