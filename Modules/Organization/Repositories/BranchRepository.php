<?php

namespace Modules\Organization\Repositories;

use Modules\Organization\Entities\District;

class BranchRepository{
	public function getAllDistricts($attribute, $value, $columns = ['*']){
		$districts = District::where($attribute, "LIKE", "%{$value}%")->get($columns);
    	return $districts;
	}
}

?>