<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 
use Modules\Employee\Entities\JobOpening;
use Modules\Employee\Entities\JobApplicant;
use Modules\Employee\Repositories\JobOpeningRepository;
use Modules\Employee\Repositories\JobApplicantRepository;

class AutoCompleteController extends Controller
{ 
	public function getJobOpenings(Request $request, JobOpeningRepository $jobOpeningRepository){ 
		return $jobOpeningRepository->all('job_title', $request->input('term'), ['id', 'job_title as text']); 
	}

	public function getJobApplicants(Request $request, JobApplicantRepository $jobApplicantRepository){ 
		return $jobApplicantRepository->all('applicant_name', $request->input('term'), ['id', 'applicant_name as text']); 
	}

	public function getJobOpeningsOfApplicant(Request $request)
	{  
		// dd($request->all());
		$job_applicant_id = $request->input('job_applicant_id');
		$job_opening = JobApplicant::with(['job_openings'=> function($query){
			$query->select('id', 'job_title as text'); 
		}])
		->find($job_applicant_id)->job_openings;
		return response()->json($job_opening);

	}

}

