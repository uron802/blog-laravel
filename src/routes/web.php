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

// トップページ
Route::get('/', 'ArticleController@index')->name('article');
// 記事詳細
Route::get('/article/show/{id}', 'ArticleController@show')->name('article.show');
// コメント登録
Route::post('/article/{id}/comment/store', 'CommentController@store')->name('comment.store');

/** 以下、要認証 */

// ダッシュボード
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
// 記事一覧
Route::get('/article/list', 'ArticleController@list')->name('article.list')->middleware('auth');
// 記事作成
Route::get('/article/create', 'ArticleController@create')->name('article.create')->middleware('auth');
// 記事編集
Route::get('/article/edit/{id}', 'ArticleController@edit')->name('article.edit')->middleware('auth');
// 記事登録
Route::post('/article/store', 'ArticleController@store')->name('article.store')->middleware('auth');
// 記事更新
Route::post('/article/update/{id}', 'ArticleController@update')->name('article.update')->middleware('auth');
// 記事削除
Route::post('/article/delete/{id}', 'ArticleController@delete')->name('article.delete')->middleware('auth');
// 下書きへ戻す
Route::post('/article/back/draft/{id}', 'ArticleController@backDraft')->name('article.back.draft')->middleware('auth');
// コメント一覧
Route::get('/comment/list', 'CommentController@list')->name('comment.list')->middleware('auth');
// コメントを承認する
Route::post('/comment/approve/{id}', 'CommentController@approve')->name('comment.approve')->middleware('auth');
// コメントを承認待ちへ戻す
Route::post('/comment/back_approval_pending/{id}', 'CommentController@backApprovalPending')->name('comment.back_approval_pending')->middleware('auth');
// コメントを削除する
Route::post('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete')->middleware('auth');
