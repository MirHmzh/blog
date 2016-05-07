<?php
Route::get('/', 'PostController@index');
Route::get('/home', ['as' => 'home', 'uses' => 'PostController@index']);
Route::controllers(['auth' => 'Auth\AuthController', 'password' => 'Auth\PasswordController']);
Route::group(['middleware' => ['auth']], function(){
	Route::get('tambah-post', 'PostController@buat');
	Route::post('tambah-post', 'PostController@tambah');
	Route::get('edit/{slug}', 'PostController@edit');
	Route::post('perbarui', 'PostController@perbarui');
	Route::get('hapus/{id}', 'PostController@hapus');
	Route::get('semua-post', 'UserController@semua_post');
});
Route::get('user/{id}', 'UserController@profil')->where('id', '[0-9]+');
Route::get('user/{id}/posts', 'UserController@user_posts')->where('id', '[0-9]+');
Route::get('/{slug}', ['as'=>'post', 'uses'=>'PostController@tampil']);