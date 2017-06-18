<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Attendance\Http\Controllers'], function()
{


	Route::get('attendance/get_employees', 'AttendanceController@getEmployees'); 
    
    Route::resource('/attendance', 'AttendanceController');
    Route::get('/bulk_attendance', 'AttendanceController@bulkAttendance');

});
