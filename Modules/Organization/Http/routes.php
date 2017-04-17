<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Organization\Http\Controllers'], function()
{
    // Route::get('/', 'OrganizationController@index');
	Route::get('/branch/get_branch_types', 'BranchController@getBranchTypes'); 
	Route::get('/branch/get_districts', 'BranchController@getDistricts'); 
	Route::get('/branch/get_post_offices', 'BranchController@getPostOffices'); 
	Route::get('/branch/get_all_branches', 'BranchController@getAllBranches'); 
	Route::resource('branch', 'BranchController');
});
