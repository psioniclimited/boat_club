<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Attendance\Http\Controllers'], function()
{


	Route::get('attendance/get_employees', 'AttendanceController@getEmployees'); 
    Route::get('/bulk_attendance', 'AttendanceController@bulkAttendance');
    Route::post('/attendance/bulk_attendance', 'AttendanceController@storeBulkAttendance');
    
    Route::resource('/attendance', 'AttendanceController');
    

    Route::get('/get_attendance_list_table/', 'AttendanceListController@getAttendanceLog');
    Route::resource('/attendance_list', 'AttendanceListController');
    



});
