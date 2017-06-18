<?php

namespace Modules\Attendance\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;
class AttendanceLog extends Model
{
	use SoftDeletes;
	protected $table = 'attendance_log';
	protected $fillable = ['working_date','punch_in_time','punch_out_time','employees_master_id'];
	public $timestamps=true;
	protected $dates = ['deleted_at'];



	public function setWorkingDateAttribute($value)
	{     
		$date=date_create($value);  
		$this->attributes['working_date'] = date_format($date,"Y-m-d");
	}
	
	public function setPunchInTimeAttribute($value)
	{      
		$time=date("H:i:s", strtotime($value));  
		$this->attributes['punch_in_time'] = $time;
	}
	public function setPunchOutTimeAttribute($value)
	{      
		$time=date("H:i:s", strtotime($value));  
		$this->attributes['punch_out_time'] = $time;
	}

	public function employees_master()
	{  
		return $this->belongsTo('Modules\Employee\Entities\EmployeeMaster','employees_master_id'); 
	}


}
