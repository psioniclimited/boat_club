<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Leave\Http\Controllers'], function()
{

	Route::get('/leave_ledger/auto/get_employees', 'AutoCompleteController@getEmployeesOfLeaveLedger'); 
	Route::get('/leave_ledger/auto/get_leave_types', 'AutoCompleteController@getLeaveTypeOfLeaveLedger'); 
	
	Route::get('/leave_application/get_all_leave_applications', 'LeaveApplicationController@getAllLeaveApplications');
	Route::resource('/leave_application', 'LeaveApplicationController');


	Route::get('/leave_approval/get_all_leave_applications', 'LeaveApprovalController@getAllLeaveApplications');
	Route::resource('/leave_approval', 'LeaveApprovalController');



});
