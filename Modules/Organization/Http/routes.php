<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Organization\Http\Controllers'], function()
{
	Route::get('/branch/auto/get_branch_types', 'AutoCompleteController@getBranchTypes'); 
	Route::get('/branch/auto/get_branchs', 'AutoCompleteController@getBranchs'); 
	Route::get('/branch/auto/get_districts', 'AutoCompleteController@getDistricts'); 
	Route::get('/branch/auto/get_departments', 'AutoCompleteController@getDepartmentOfBranch'); 
	Route::get('/branch/auto/get_post_offices', 'AutoCompleteController@getPostOffices'); 
	Route::get('/branch/auto/get_branch_district', 'AutoCompleteController@getDistrictOfBranch');
	Route::get('/branch/auto/get_branch_post_office', 'AutoCompleteController@getPostOfficeOfBranch');
	Route::get('/branch/auto/get_branch_branch_type', 'AutoCompleteController@getBranchTypeOfBranch');
	Route::get('/branch/auto/get_work_shifts', 'AutoCompleteController@getWorkShifts');
	

	Route::get('/leave_type/auto/get_leave_types', 'AutoCompleteController@getLeaveTypes');

	Route::get('/department/auto/get_department_types', 'AutoCompleteController@getDepartmentTypes');
	Route::get('/department/auto/get_department/department_type', 'AutoCompleteController@getDepartmentTypeOfDepartment');
	Route::get('/department/auto/get_department/branch', 'AutoCompleteController@getBranchOfDepartment');
	
	Route::get('/designation/auto/get_designations', 'AutoCompleteController@getDesignations');
	

	Route::get('/salary_head/auto/salary_head', 'AutoCompleteController@getSalaryHead');
	Route::get('/salary_grade/auto/get_salary_grades', 'AutoCompleteController@getSalaryGrades');

	Route::get('/holiday/auto/get_holiday_lists', 'AutoCompleteController@getHolidayLists');
	Route::get('/week_holiday/auto/get_week_holiday_masters', 'AutoCompleteController@getWeekHolidayMasters');
	
	Route::get('/attendance_deduction/auto/get_attendance_deduction_policies', 'AutoCompleteController@getAttendanceDeductionMasters');
	Route::get('/leave_package/auto/get_leave_packages', 'AutoCompleteController@getLeavePackages');
	
	Route::get('/loan_type/auto/get_loan_types', 'AutoCompleteController@getLoanTypes');
	



	Route::get('/testdb', 'AutoCompleteController@returnTestJson');




	Route::get('/district/get_all_districts', 'DistrictController@getAllDistricts'); 
	Route::resource('district', 'DistrictController');

	Route::get('/post_office/auto/get_district', 'AutoCompleteController@getDistrictOfPostOffice'); 
	Route::get('/post_office/get_all_post_offices', 'PostOfficeController@getAllPostOffices'); 
	Route::resource('post_office', 'PostOfficeController');

	Route::get('/branch_type/get_all_branch_types', 'BranchTypeController@getAllBranchTypes'); 
	Route::resource('branch_type', 'BranchTypeController');

	Route::get('/branch/get_all_branches', 'BranchController@getAllBranches'); 
	Route::resource('branch', 'BranchController');

	Route::get('/department_type/get_all_department_types', 'DepartmentTypeController@getAllDepartmentTypes');
	Route::resource('department_type', 'DepartmentTypeController');

	Route::get('/department/get_all_departments', 'DepartmentController@getAllDepartments');
	Route::resource('department', 'DepartmentController');

	Route::get('/designation/get_all_designations', 'DesignationController@getAllDesignations');
	Route::resource('designation', 'DesignationController');

	Route::get('/work_shift/get_all_work_shifts', 'WorkShiftController@getAllWorkShifts');
	Route::resource('/work_shift', 'WorkShiftController');

	Route::get('/salary_head/get_all_salary_heads', 'SalaryHeadController@getAllSalaryHeads');
	Route::resource('/salary_head', 'SalaryHeadController');

	Route::get('/salary_grade/get_all_salary_grades', 'SalaryGradeController@getAllSalaryGrades'); 
	Route::post('/salary_grade/create_new_grade_info/', 'SalaryGradeController@createNewGradeInfo');
	Route::get('/salary_grade/grade_info/', 'SalaryGradeController@gradeInfo'); 
	Route::get('/salary_grade/salary_grade_info/{salary_grade_master_id}', 'SalaryGradeController@salaryGradeInfo'); 

	Route::get('/salary_grade/basic_salary_of_grade/{salary_grade_master_id}', 'SalaryGradeController@getBasicSalaryOfSalaryGrade'); 
	
	Route::post('/salary_grade/store_grade_info/', 'SalaryGradeController@storeGradeInfo');  	
	Route::resource('/salary_grade', 'SalaryGradeController',['parameters' => [
		'salary_grade' => 'salary_grade_master'
		]]);

	Route::get('/week_holiday/get_all_week_holidays', 'WeekHolidayController@getAllWeekHolidays');
	Route::resource('/week_holiday', 'WeekHolidayController', ['parameters' => [
		'week_holiday' => 'week_holiday_master'
		]]);
	
	Route::get('/holiday/get_all_holidays', 'HolidayController@getAllHolidays');
	Route::get('/holiday/details/{id}', 'HolidayController@holidayDetails');
	Route::get('/holiday/get_all_holiday_lists', 'HolidayController@getAllHolidayLists');
	Route::post('/holiday/store_holiday_info', 'HolidayController@storeHolidayInfo');
	Route::resource('/holiday', 'HolidayController');

	Route::get('/attendance_deduction/get_all_deduction_policies', 'AttendanceDeductionController@getAllDeductionPolicies');
	Route::resource('/attendance_deduction', 'AttendanceDeductionController');

	Route::get('/leave_type/get_all_leave_types', 'LeaveTypeController@getAllLeaveTypes');
	Route::resource('/leave_type', 'LeaveTypeController');


	Route::get('/leave_package/get_all_leave_packages', 'LeavePackageController@getAllLeavePackages');
	Route::resource('/leave_package', 'LeavePackageController');

	// Route::get('/test_employee/{id}', 'LeavePackageController@getAllLeavePackages');

	Route::get('/loan_type/get_all_loan_types', 'LoanTypeController@getAllLoanTypes');
	Route::resource('/loan_type', 'LoanTypeController');
});
