<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model; 
class BloodGroup extends Model
{ 
	protected $table = 'blood_group'; 
	public $timestamps=false;  
	
	public function employees_master()
	{   
		return $this->hasMany('Modules\Employee\Entities\EmployeeMaster'); 
	}
	

}
