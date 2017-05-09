<?php

namespace Modules\Organization\Repositories;

use Modules\Organization\Entities\BranchType;
use Modules\Organization\Entities\Branch;
use Modules\Organization\Entities\District;
use Modules\Organization\Entities\DepartmentType;
use Modules\Organization\Entities\PostOffice;
use Modules\Organization\Entities\SalaryHead;

class BranchRepository{
	public function getAllBranchTypes($attribute, $value, $columns = ['*']){
		$branch_types = BranchType::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $branch_types;
	}
	public function getAllBranchs($attribute, $value, $columns = ['*']){
		$branch = Branch::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $branch;
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
		$post_offices = PostOffice::where($attribute, "LIKE", "%{$value}%")->where('district_id', "=", $district_id)->get($columns);
		return $post_offices;
	}	public function getSalaryHeads($attribute, $value, $district_id, $columns = ['*']){
		$department_types = SalaryHead::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $department_types;
	}
}

?>