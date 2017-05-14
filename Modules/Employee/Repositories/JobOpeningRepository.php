<?php

namespace Modules\Employee\Repositories;

use Modules\Contracts\RepositoryContract; 
use Modules\Employee\Entities\JobOpening; 

class JobOpeningRepository implements RepositoryContract{ 

	public function all($attribute, $value, $columns = ['*']){ 
		$job_openings = JobOpening::where($attribute, "LIKE", "%{$value}%")
		->where('job_opening_status', '=', 1)
		->get($columns);
		return $job_openings;
	}
	public function find($id, $columns = array('*')){
		return null;
	}

}

?>