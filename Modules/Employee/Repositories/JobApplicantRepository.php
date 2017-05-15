<?php

namespace Modules\Employee\Repositories;

use Modules\Contracts\RepositoryContract; 
use Modules\Employee\Entities\JobApplicant; 

class JobApplicantRepository implements RepositoryContract{ 

	public function all($attribute, $value, $columns = ['*']){ 
		$job_applicants = JobApplicant::where($attribute, "LIKE", "%{$value}%") 
		->get($columns);
		return $job_applicants;
	}
	public function find($id, $columns = array('*')){
		return null;
	}

}

?>