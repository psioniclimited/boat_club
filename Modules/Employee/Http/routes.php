<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Employee\Http\Controllers'], function()
{ 
	Route::get('/job_opening/auto', 'AutoCompleteController@getJobOpenings'); 
	Route::get('/job_applicant/auto/get_job_opening', 'AutoCompleteController@getJobOpeningsOfApplicant'); 
	Route::get('/job_applicant/auto', 'AutoCompleteController@getJobApplicants'); 







	Route::get('/job_opening/get_all_job_openings', 'JobOpeningController@getAllJobOpenings');  
	Route::resource('/job_opening', 'JobOpeningController');

	Route::get('/job_applicant/get_all_job_applicants', 'JobApplicantController@getAllJobApplicants');  
	Route::resource('/job_applicant', 'JobApplicantController');


	Route::get('/offer_letter/get_all_offer_letters', 'OfferLetterController@getAllOfferLetters');  
	Route::resource('/offer_letter', 'OfferLetterController');


});