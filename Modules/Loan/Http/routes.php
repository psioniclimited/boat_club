<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Loan\Http\Controllers'], function()
{ 


	Route::get('/loan_application/auto/get_employees', 'AutoCompleteController@getEmployeesOfLoanApplication'); 
	Route::get('/loan_application/auto/get_loan_types', 'AutoCompleteController@getLoanTypeOfLoanApplication'); 
	


	Route::get('loan_application/get_all_loan_applications', 'LoanApplicationController@getAllApplications');
	Route::resource('loan_application', 'LoanApplicationController');

	Route::get('loan_approval/get_all_loan_applications', 'LoanApprovalController@getAllApplications');
	Route::resource('loan_approval', 'LoanApprovalController');

});
