<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;
class EmployeePreviousJobExperience extends Model
{
	use SoftDeletes;
	protected $table = 'employee_previous_job_experience';
	protected $fillable = ['designation','institution','from_date','to_date','employees_master_id'];
	public $timestamps=true;
	protected $dates = ['deleted_at'];

	
	public function employees_master()
	{  
		return $this->belongsTo('Modules\Employee\Entities\EmployeeMaster','employees_master_id'); 
	}


}
