<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model; 
class EmployeeSeries extends Model
{ 
	protected $table = 'employee_series'; 
	public $timestamps=false;  
	
	public function employees_master()
	{   
		return $this->hasMany('Modules\Employee\Entities\EmployeeMaster'); 
	}
	

}
