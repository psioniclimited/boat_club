<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 
use Modules\Employee\Entities\JobOpening;
use Modules\Employee\Entities\JobApplicant;
use Modules\Employee\Entities\OfferLetter;
use Modules\Employee\Entities\EmployeeJobInfo;
use Modules\Employee\Entities\EmployeeSalaryInformation;
use Modules\Employee\Entities\EmployeeFamilyMembers;
use Modules\Employee\Entities\FamilyRelation;
use DB;
use Modules\Employee\Repositories\JobOpeningRepository;
use Modules\Employee\Repositories\JobApplicantRepository;
use Modules\Employee\Repositories\FamilyRelationRepository;

use Modules\Employee\Repositories\EmployeeRepository; 

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

	public function getEmployees(Request $request, EmployeeRepository $Employee){ 
		return $Employee->all('employee_code', $request->input('term'), ['id','employee_fullname','contact_number', 'employee_code as text']); 
	}

	public function getResignedEmployees(Request $request, EmployeeRepository $Employee){ 
		return $Employee->resigned('employee_code', $request->input('term'), ['id','employee_fullname','contact_number', 'employee_code as text']); 
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


	public function getDepartmentBranchOfEmPloyeeJobInfo(Request $request)
	{   
		$employee_job_info = $request->input('employee_job_info');

		$branch= EmployeeJobInfo::with(['branch'=> function($query){
			$query->select('id', 'branch_name as text'); 
		}])
		->find($employee_job_info)->branch;
		return response()->json($branch);
	}

	public function getDepartmentOfEmPloyeeJobInfo(Request $request)
	{   
		$employee_job_info = $request->input('employee_job_info');

		$department= EmployeeJobInfo::with(['department'=> function($query){
			$query->select('id', 'department_name as text'); 
		}])
		->find($employee_job_info)->department;
		return response()->json($department);
	}

	public function getDesignationOfEmPloyeeJobInfo(Request $request)
	{   
		$employee_job_info = $request->input('employee_job_info');

		$designation= EmployeeJobInfo::with(['designation'=> function($query){
			$query->select('id', 'designation_name as text'); 
		}])
		->find($employee_job_info)->designation;
		return response()->json($designation);
	}
	public function getWorkShiftOfEmPloyeeJobInfo(Request $request)
	{   
		$employee_job_info = $request->input('employee_job_info');

		$work_shift= EmployeeJobInfo::with(['work_shift'=> function($query){
			$query->select('id', 'shift_name as text'); 
		}])
		->find($employee_job_info)->work_shift;
		return response()->json($work_shift);
	}

	public function getHolidayListOfEmPloyeeJobInfo(Request $request)
	{   
		$employee_job_info = $request->input('employee_job_info');

		$holiday= EmployeeJobInfo::with(['holiday_list'=> function($query){
			$query->select('id', 'holiday_list_name as text'); 
		}])
		->find($employee_job_info)->holiday_list;
		return response()->json($holiday);
	}

	public function getWeekHolidayOfEmPloyeeJobInfo(Request $request)
	{   
		$employee_job_info = $request->input('employee_job_info');

		$week_holiday_master= EmployeeJobInfo::with(['week_holiday_master'=> function($query){
			$query->select('id', 'week_holiday_master_name as text'); 
		}])
		->find($employee_job_info)->week_holiday_master;
		return response()->json($week_holiday_master);
	}

	public function getSalaryGradeOfEmployeeSalaryInfo(Request $request)
	{   
		$employee_salary_info = $request->input('employee_salary_info');

		$salary_grade= EmployeeSalaryInformation::with(['salary_grade_master'=> function($query){
			$query->select('id', 'salary_grade_name as text'); 
		}])
		->find($employee_salary_info)->salary_grade_master;
		return response()->json($salary_grade);
	}


	public function getFamilyRelationOfFamilyMembers(Request $request)
	{    
		$employee_family_members_id = $request->input('employee_family_members_id');

		// dd($employee_family_members_id);
		$family_relation= EmployeeFamilyMembers::with(['family_relation'=> function($query){
			$query->select('id', 'relation_name as text'); 
		}])
		->find($employee_family_members_id)->family_relation;

		return response()->json($family_relation);
	}



}

