<?php
//ログイン機能
Auth::routes();

// トップページ
Route::get('/','ItemController@index')->name('top');

//新規投稿
Route::get('items/create','ItemController@create')->name('items.create');
Route::post('items/store','ItemController@store')->name('items.store');

//投稿編集
Route::get('items/{item}/edit','ItemController@edit')->name('items.edit');
Route::patch('items/{item}/update','ItemController@update')->name('items.update');

//投稿消去
Route::delete('items/{items}/destroy','ItemController@destroy')->name('items.destroy');

// フォロー機能
Route::post('/users/{user}/follow', 'FollowController@store')->name('follows.store');
Route::delete('/users/{user}/unfollow', 'FollowController@destroy')->name('follows.destroy');

// ユーザー詳細
Route::get('users/{user}/show','UserController@show')->name('users.show');

//ユーザー情報編集
Route::get('users/{user}/edit','UserController@edit')->name('users.edit');
Route::patch('users/{user}/update','UserController@update')->name('users.update');