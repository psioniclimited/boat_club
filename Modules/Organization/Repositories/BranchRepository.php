<?php

namespace Modules\Organization\Repositories;

use Modules\Organization\Entities\BranchType;
use Modules\Organization\Entities\Branch;
use Modules\Organization\Entities\District;
use Modules\Organization\Entities\DepartmentType;
use Modules\Organization\Entities\Designation;
use Modules\Organization\Entities\PostOffice;
use Modules\Organization\Entities\SalaryHead;
use Modules\Organization\Entities\SalaryGradeMaster;
use Modules\Organization\Entities\WorkShift;
use Modules\Organization\Entities\LeaveType;
use Modules\Organization\Entities\LoanType;
use Modules\Organization\Entities\LeavePackage;
use Modules\Organization\Entities\AttendanceDeductionMaster;

use Modules\Organization\Entities\HolidayList;
use Modules\Organization\Entities\WeekHolidayMaster; 

class BranchRepository{
	public function getAllBranchTypes($attribute, $value, $columns = ['*']){
		$branch_types = BranchType::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $branch_types;
	}
	public function getAllBranchs($attribute, $value, $columns = ['*']){
		$branch = Branch::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $branch;
	}
	
	public function getAllWorkShifts($attribute, $value, $columns = ['*']){
		$work_shifts = WorkShift::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $work_shifts;
	}
	public function getAllDistricts($attribute, $value, $columns = ['*']){
		$districts = District::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $districts;
	}
	public function getAllDepartmentTypes($attribute, $value, $columns = ['*']){
		$department_types = DepartmentType::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $department_types;
	}

	public function getPostOffices($attribute, $value, $district_id, $columns = ['*']){
		// dd($district_id);
		$post_offices = PostOffice::where($attribute, "LIKE", "%{$value}%")->where('district_id', "=", $district_id)->get($columns);
		return $post_offices;
	}	
	public function getSalaryHeads($attribute, $value, $district_id, $columns = ['*']){
		$department_types = SalaryHead::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $department_types;
	}
	public function getSalaryGradess($attribute, $value,$columns = ['*']){
		$salary_grades = SalaryGradeMaster::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $salary_grades;
	}

	public function getAttendanceDeductionMasters($attribute, $value,$columns = ['*']){
		$attendance_deductions = AttendanceDeductionMaster::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $attendance_deductions;
	}

	public function getLeavePackages($attribute, $value,$columns = ['*']){
		$leave_package = LeavePackage::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $leave_package;
	}

	public function getDesignations($attribute, $value,$columns = ['*']){

		$designations = Designation::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $designations;
	}


	public function getHolidayLists($attribute, $value,$columns = ['*']){

		$holiday_lists = HolidayList::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $holiday_lists;
	}
	public function getWeekHolidayMasters($attribute, $value,$columns = ['*']){
		$holidays = WeekHolidayMaster::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $holidays;
	}


	public function getLeaveTypes($attribute, $value,$columns = ['*']){

		$leave_types = LeaveType::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $leave_types;
	}
	public function getLoanTypes($attribute, $value,$columns = ['*']){

		$loan_types = LoanType::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $loan_types;
	}


}

?>