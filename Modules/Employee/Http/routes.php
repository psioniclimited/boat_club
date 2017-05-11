<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Employee\Http\Controllers'], function()
{
	Route::get('/', 'EmployeeController@index');

	Route::get('/job_opening/get_all_job_openings', 'JobOpeningController@getAllJobOpenings');  
	Route::resource('/job_opening', 'JobOpeningController');


});
