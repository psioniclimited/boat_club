<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Attendance\Http\Controllers'], function()
{
    Route::resource('/attendance', 'AttendanceController');
    Route::get('/attendance_punch_in', 'AttendanceController@punchInIndex');

});
