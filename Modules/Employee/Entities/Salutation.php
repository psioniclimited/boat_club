<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model; 
class Salutation extends Model
{ 
	protected $table = 'salutation'; 
	public $timestamps=false;  
	
	public function employees_master()
	{  
		// return $this->hasMany('Modules\Employee\Entities\FamilyRelation','family_relation_id'); 
		return $this->hasMany('Modules\Employee\Entities\EmployeeMaster'); 
	}
 

}
