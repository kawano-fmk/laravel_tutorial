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

Route::get('/posts','PostsController@index')->name('index');

Route::resource('/posts', 'PostsController');

# 入力画面
Route::post('validation/', [
    'uses' => 'ValiController@getIndex',
    'as' => 'validation.index'
  ]);
   
# 確認画面
Route::post('validation/confirm', [
    'uses' => 'ValiController@confirm',
    'as' => 'validation.confirm'
  ]);
  
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('posts/show', 'PostsController@show');

Route::Post('/comment', 'PostsController@comment');

Route::group(['middleware' => 'auth'], function() {
  Route::resource('posts','PostsController', ['only' => ['create','store','edit','update','destroy']]);
});

Route::resource('posts','PostsController',['only' => ['index','show']]);

Route::delete('posts/comment_destroy/{id}', 'PostsController@comment_destroy')->name('comment.destroy');

//Get　ヘッダーにのみ作用します
//Post ヘッダー・ボディ・フッターに作用します（見えない）