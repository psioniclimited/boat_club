<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;
class EmployeeWorkHistoryInCompany extends Model
{
	use SoftDeletes;
	protected $table = 'employee_work_history_in_company';
	protected $fillable = ['department_branch_id','department_id','designation_id','remarks','employees_master_id'];
	public $timestamps=true;
	protected $dates = ['deleted_at'];

	public function branch()
	{  
		return $this->belongsTo('Modules\Organization\Entities\Branch','department_branch_id'); 
	}

	public function department()
	{  
		return $this->belongsTo('Modules\Organization\Entities\Department','department_id'); 
	}
	
	public function designation()
	{  
		return $this->belongsTo('Modules\Organization\Entities\Designation','designation_id'); 
	}

	public function employees_master()
	{  
		return $this->belongsTo('Modules\Employee\Entities\EmployeeMaster','employees_master_id'); 
	}

	public function setDateAttribute($value)
	{     
		$date=date_create($value);  
		$this->attributes['date'] = date_format($date,"Y-m-d");
	}
}
