<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/login', 'UserController@index');
    Route::post('/login', 'UserController@loginUser');
});
