<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model; 
class MaritalStatus extends Model
{ 
	protected $table = 'marital_status'; 
	public $timestamps=false;  
	
	public function employees_master()
	{   
		return $this->hasMany('Modules\Employee\Entities\EmployeeMaster'); 
	}
	

}
