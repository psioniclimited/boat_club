<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 
use Modules\Employee\Entities\JobOpening;
use Modules\Employee\Entities\JobApplicant;
use Modules\Employee\Entities\OfferLetter;
use Modules\Employee\Repositories\JobOpeningRepository;
use Modules\Employee\Repositories\JobApplicantRepository;
use Modules\Employee\Repositories\FamilyRelationRepository;

class AutoCompleteController extends Controller
{ 
	public function getJobOpenings(Request $request, JobOpeningRepository $jobOpeningRepository){ 
		return $jobOpeningRepository->all('job_title', $request->input('term'), ['id', 'job_title as text']); 
	}

	public function getJobApplicants(Request $request, JobApplicantRepository $jobApplicantRepository){ 
		return $jobApplicantRepository->all('applicant_name', $request->input('term'), ['id', 'applicant_name as text']); 
	}

	public function getAllFamilyRelations(Request $request, FamilyRelationRepository $FamilyRelation){ 
		return $FamilyRelation->all('relation_name', $request->input('term'), ['id', 'relation_name as text']); 
	}

	public function getJobOpeningsOfApplicant(Request $request)
	{  
		$job_applicant_id = $request->input('job_applicant_id');
		$job_opening = JobApplicant::with(['job_openings'=> function($query){
			$query->select('id', 'job_title as text'); 
		}])
		->find($job_applicant_id)->job_openings;
		return response()->json($job_opening);

	}

	public function getJobApplicantOfOfferLetter(Request $request)
	{   
		$offer_letter_id = $request->input('offer_letter_id');
		$job_applicant = OfferLetter::with(['job_applicant'=> function($query){
			$query->select('id', 'applicant_name as text'); 
		}])
		->find($offer_letter_id)->job_applicant;
		return response()->json($job_applicant);
	}

	public function getDepartmentBranchOfOfferLetter(Request $request)
	{   
		$offer_letter_id = $request->input('offer_letter_id');
		$branch = OfferLetter::with(['branch'=> function($query){
			$query->select('id', 'branch_name as text'); 
		}])
		->find($offer_letter_id)->branch;
		return response()->json($branch);
	}
	public function getDepartmentOfOfferLetter(Request $request)
	{   
		$offer_letter_id = $request->input('offer_letter_id');
		$department= OfferLetter::with(['department'=> function($query){
			$query->select('id', 'department_name as text'); 
		}])
		->find($offer_letter_id)->department;
		return response()->json($department);
	}
	public function getDesignationOfOfferLetter(Request $request)
	{   
		$offer_letter_id = $request->input('offer_letter_id');
		$designation= OfferLetter::with(['designation'=> function($query){
			$query->select('id', 'designation_name as text'); 
		}])
		->find($offer_letter_id)->designation;
		return response()->json($designation);
	}

}

