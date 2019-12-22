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
Route::get('/register/complete', 'Auth\RegisterController@complete')->name('register.complete');

// トップページ
Route::get('/', 'Article\Controller@index')->name('article');
// 記事詳細
Route::get('/article/show/{article}', 'Article\Controller@show')->name('article.show');
// コメント登録
Route::post('/article/{article}/comment/store', 'CommentController@store')->name('comment.store');
// 記事のいいね数を増加する
Route::post('/article/{article}/plusLikeNum', 'Article\Controller@plusLikeNum')->name('article.plusLikeNum');

/* 以下、要認証 */

// ダッシュボード
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
// 記事一覧
Route::get('/article/list', 'Article\Controller@list')->name('article.list')->middleware('auth');
// 記事作成
Route::get('/article/create', 'Article\Controller@create')->name('article.create')->middleware('auth');
// 記事編集
Route::get('/article/edit/{article}', 'Article\Controller@edit')->name('article.edit')->middleware('auth');
// 記事を公開する
Route::post('/public/article/store', 'Article\PublicController@store')->name('public.article.store')->middleware('auth');
// 記事を下書きで登録する
Route::post('/private/article/store', 'Article\PrivateController@store')->name('private.article.store')->middleware('auth');
// 記事を更新して公開する
Route::post('/public/article/update/{article}', 'Article\PublicController@update')->name('public.article.update')->middleware('auth');
// 記事を更新して下書きで保存する
Route::post('/private/article/update/{article}', 'Article\PrivateController@update')->name('private.article.update')->middleware('auth');
// 記事削除
Route::post('/article/delete/{article}', 'Article\Controller@delete')->name('article.delete')->middleware('auth');
// コメント一覧
Route::get('/comment/list', 'CommentController@list')->name('comment.list')->middleware('auth');
// コメントを承認する
Route::post('/comment/approve/{comment}', 'CommentController@approve')->name('comment.approve')->middleware('auth');
// コメントを承認待ちへ戻す
Route::post('/comment/back_approval_pending/{comment}', 'CommentController@backApprovalPending')->name('comment.back_approval_pending')->middleware('auth');
// コメントを削除する
Route::post('/comment/delete/{comment}', 'CommentController@delete')->name('comment.delete')->middleware('auth');
// カテゴリー一覧
Route::get('/tag/list', 'TagController@list')->name('tag.list')->middleware('auth');
// カテゴリー編集
Route::get('/tag/edit/{tag}', 'TagController@edit')->name('tag.edit')->middleware('auth');
// カテゴリー更新
Route::post('/tag/update/{tag}', 'TagController@update')->name('tag.update')->middleware('auth');
// カテゴリー削除
Route::post('/tag/delete/{tag}', 'TagController@delete')->name('tag.delete')->middleware('auth');
// ユーザー一覧
Route::get('/user/list', 'UserController@list')->name('user.list')->middleware('auth');
// ユーザー有効化
Route::post('/user/activate/{user}', 'UserController@activate')->name('user.activate')->middleware('auth');
