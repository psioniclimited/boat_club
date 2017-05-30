<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model; 
class Religion extends Model
{ 
	protected $table = 'religion'; 
	public $timestamps=false;  
	
	public function employees_master()
	{   
		return $this->hasMany('Modules\Employee\Entities\EmployeeMaster'); 
	}
	

}
