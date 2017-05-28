<?php

namespace Modules\Employee\Repositories;

use Modules\Contracts\RepositoryContract; 
use Modules\Employee\Entities\FamilyRelation; 

class FamilyRelationRepository implements RepositoryContract{ 

	public function all($attribute, $value, $columns = ['*']){ 
		$relations = FamilyRelation::where($attribute, "LIKE", "%{$value}%") 
		->get($columns);
		return $relations;
	}
	public function find($id, $columns = array('*')){
		return null;
	}

}

?>