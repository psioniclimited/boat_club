<?php

namespace Modules\Employee\Repositories;

use Modules\Contracts\RepositoryContract; 
use Modules\Employee\Entities\EmployeeMaster; 

class EmployeeRepository implements RepositoryContract{ 

	public function all($attribute, $value, $columns = ['*']){ 
		$relations = EmployeeMaster::where($attribute, "LIKE", "%{$value}%") 
		->get($columns);
		return $relations;
	}
	public function find($id, $columns = array('*')){
		return null;
	}

	public function resigned($attribute, $value, $columns = ['*']){ 
		$relations = EmployeeMaster::where($attribute, "LIKE", "%{$value}%")
		->where('employee_status',"=","0") 
		->get($columns);
		return $relations;
	}

}

?>