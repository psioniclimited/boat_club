<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;
class EmployeeEducationalBackground extends Model
{
	use SoftDeletes;
	protected $table = 'employee_educational_background';
	protected $fillable = ['degree_name','institution','passing_year','employees_master_id'];
	public $timestamps=true;
	protected $dates = ['deleted_at'];

 
	public function employees_master()
	{  
		return $this->belongsTo('Modules\Employee\Entities\EmployeeMaster','employees_master_id'); 
	}


}
