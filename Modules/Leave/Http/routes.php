<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Leave\Http\Controllers'], function()
{
	
    Route::get('/leave_application/get_all_leave_applications', 'LeaveApplicationController@getAllLeaveApplications');
    Route::resource('/leave_application', 'LeaveApplicationController');
});
