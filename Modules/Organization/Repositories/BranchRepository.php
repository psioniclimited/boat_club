<?php

namespace Modules\Organization\Repositories;

use Modules\Organization\Entities\BranchType;
use Modules\Organization\Entities\District;
use Modules\Organization\Entities\PostOffice;

class BranchRepository{
	public function getAllBranchTypes($attribute, $value, $columns = ['*']){
		$branch_types = BranchType::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $branch_types;
	}
	public function getAllDistricts($attribute, $value, $columns = ['*']){
		$districts = District::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $districts;
	}

	public function getPostOffices($attribute, $value, $columns = ['*']){
		$post_offices = PostOffice::where($attribute, "LIKE", "%{$value}%")->get($columns);
		return $post_offices;
	}
}

?>