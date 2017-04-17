<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Organization\Http\Controllers'], function()
{
    // Route::get('/', 'OrganizationController@index');
	Route::get('/branch/get_districts', 'BranchController@getDistricts'); 
	Route::resource('branch', 'BranchController');
});
