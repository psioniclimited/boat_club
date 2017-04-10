<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
	Route::resource('/', 'UserController');

    Route::post('/login', ['uses'=>'UserController@login']);
  
});
