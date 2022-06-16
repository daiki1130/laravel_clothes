<?php
//ログイン機能
Auth::routes();

// サイト説明
Route::get('/description','DefaultController@description')->name('description');

// トップページ
Route::get('/','DefaultController@index')->name('top');

//新規投稿
Route::get('/items/create','ItemController@create')->name('items.create');
Route::post('/items/store','ItemController@store')->name('items.store');

//投稿編集
Route::get('/items/{item}/edit','ItemController@edit')->name('items.edit');
Route::patch('/items/{item}/update','ItemController@update')->name('items.update');

// アイテム詳細
Route::get('/items/{item}','ItemController@show')->name('items.show');

//投稿消去
Route::delete('/items/{items}/destroy','ItemController@destroy')->name('items.destroy');

// お気に入り機能
Route::patch('/items/{item}/toggle_like', 'LikeController@toggleLike')->name('items.toggle_like');
Route::post('/items/{item}/store', 'CommentController@store')->name('comments.store');

// お気に入り一覧
Route::get('/likes','LikeController@index')->name('likes.index');

// フォロー機能
Route::post('/users/{user}/follow', 'FollowController@store')->name('follows.store');
Route::delete('/users/{user}/unfollow', 'FollowController@destroy')->name('follows.destroy');

// フォロー一覧
Route::get('/follows','FollowController@followIndex')->name('follows.index');

// フォロワー一覧
Route::get('/followers','FollowController@followerIndex')->name('followers.index');

// ユーザー詳細
Route::get('users/{user}/show','UserController@show')->name('users.show');

//ユーザー情報編集
Route::get('/users/{user}/edit','UserController@edit')->name('users.edit');
Route::patch('/users/{user}/update','UserController@update')->name('users.update');
Route::get('/users/edit_image', 'UserController@editImage')->name('users.edit_image');
Route::patch('/users/edit_image', 'UserController@updateImage')->name('users.update_image');