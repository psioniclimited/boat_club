<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Employee\Http\Controllers'], function()
{ 
	Route::get('/job_opening/auto', 'AutoCompleteController@getJobOpenings'); 
	Route::get('/job_applicant/auto/get_job_opening', 'AutoCompleteController@getJobOpeningsOfApplicant'); 
	Route::get('/job_applicant/auto', 'AutoCompleteController@getJobApplicants'); 


	Route::get('/family_relation/auto/get_all_relations', 'AutoCompleteController@getAllFamilyRelations'); 



	Route::get('/offer_letter/auto/get_job_applicant', 'AutoCompleteController@getJobApplicantOfOfferLetter'); 
	Route::get('/offer_letter/auto/get_department_branch', 'AutoCompleteController@getDepartmentBranchOfOfferLetter'); 
	Route::get('/offer_letter/auto/get_department', 'AutoCompleteController@getDepartmentOfOfferLetter'); 
	Route::get('/offer_letter/auto/get_designation', 'AutoCompleteController@getDesignationOfOfferLetter'); 



	Route::get('/employee_job_info/auto/department_branch_id', 'AutoCompleteController@getDepartmentBranchOfEmPloyeeJobInfo'); 
	Route::get('/employee_job_info/auto/department', 'AutoCompleteController@getDepartmentOfEmPloyeeJobInfo'); 
	Route::get('/employee_job_info/auto/designation', 'AutoCompleteController@getDesignationOfEmPloyeeJobInfo'); 
	Route::get('/employee_job_info/auto/work_shift', 'AutoCompleteController@getWorkShiftOfEmPloyeeJobInfo'); 
	Route::get('/employee_job_info/auto/holiday_list', 'AutoCompleteController@getHolidayListOfEmPloyeeJobInfo'); 
	Route::get('/employee_job_info/auto/week_holiday', 'AutoCompleteController@getWeekHolidayOfEmPloyeeJobInfo'); 
	

	Route::get('/employee_salary_info/auto/salary_grade', 'AutoCompleteController@getSalaryGradeOfEmployeeSalaryInfo'); 






	Route::get('/job_opening/get_all_job_openings', 'JobOpeningController@getAllJobOpenings');  
	Route::resource('/job_opening', 'JobOpeningController');

	Route::get('/job_applicant/get_all_job_applicants', 'JobApplicantController@getAllJobApplicants');  
	Route::resource('/job_applicant', 'JobApplicantController');


	Route::get('/offer_letter/get_all_offer_letters', 'OfferLetterController@getAllOfferLetters');  
	Route::resource('/offer_letter', 'OfferLetterController');
	

	Route::get('/create_employee', 'EmployeeController@createEmployee');
	Route::get('check_unique_employee_code','EmployeeController@checkUniqueEmployeeCode');
	Route::get('/employee/get_all_employees', 'EmployeeController@getAllEmployees');
	
	Route::post('/employee_salary_information/salary_head_id/get_amount', 'EmployeeController@getAmountOfSalaryHead'); 
	
	Route::get('/employee/salary_heads_with_amount', 'EmployeeController@getSalaryHeadsWithAmount'); 

	Route::resource('/employee', 'EmployeeController');


});
