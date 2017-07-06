<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Leave\Http\Controllers'], function()
{
	
    Route::resource('/leave_application', 'LeaveApplicationController');
});
