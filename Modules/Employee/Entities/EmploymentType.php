<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model; 
class EmploymentType extends Model
{ 
	protected $table = 'employment_type'; 
	public $timestamps=false;  
	
	public function employee_job_info()
	{   
		return $this->hasMany('Modules\Employee\Entities\EmployeeJobInfo'); 
	}
 

}
