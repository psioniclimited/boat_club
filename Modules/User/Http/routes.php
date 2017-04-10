<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/login', 'UserController@index');
    Route::post('/login', 'UserController@loginUtser');
    Route::get('/create_users', 'UserController@createUsers');
    Route::post('/create_users_process', 'UserController@createUsersProcess');
});
