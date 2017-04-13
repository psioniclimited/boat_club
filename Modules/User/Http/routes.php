<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
	Route::get('/user/all_users', ['uses'=>'UserController@showAllUsers']);
	Route::get('/user/get_users', ['uses'=>'UserController@getUsers']);
	Route::post('/login', ['uses'=>'UserController@login']);
	Route::resource('user', 'UserController'); 
});
