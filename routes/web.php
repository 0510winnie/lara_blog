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

Route::get('/', 'PagesController@root')->name('root');

Auth::routes();
Route::resource('users', 'UsersController', ['only' => ['show','update','edit']]);
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
Route::resource('replies', 'RepliesController', ['only' => ['store','destroy']]);
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::resource('notifications','NotificationsController', ['only' => ['index']]);
//{topic} 是隱性路由模型綁定的提示，將會自動注入id對應的話題實例
// {slug?} ?表示參數可選，為了兼容數據庫裡slug為空的topics data
//這種寫法可同時兼容以下
// topics/110 & topics/110/slug-test 

