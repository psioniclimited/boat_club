<?php

Route::group(['middleware' => 'web', 'prefix' => 'leave', 'namespace' => 'Modules\Leave\Http\Controllers'], function()
{
    Route::get('/', 'LeaveController@index');
});
