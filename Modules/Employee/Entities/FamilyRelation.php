<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;  
class FamilyRelation extends Model
{ 
	protected $table = 'family_relation';

	public $timestamps=false; 


	public function employee_family_members()
	{  
		return $this->hasMany('Modules\Employee\Entities\EmployeeFamilyMembers'); 
	}

}
