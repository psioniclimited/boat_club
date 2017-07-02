<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceDeductionMaster extends Model
{
	use SoftDeletes;

	protected $table = 'attendance_deduction_master';
	
	public $timestamps = false;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['deduction_policy_name','late_entry_time','early_out_time', 'late_entry_day_count','late_entry_deduction_day','late_entry_deduction_valid','early_out_day_count','early_out_deduction_day','early_out_deduction_valid'];


	public function getLateEntryTimeAttribute($value)
	{ 
		return \Carbon\Carbon::createFromFormat('H:m:s', $value)->format('h:i A');
	}

	public function setLateEntryTimeAttribute($value)
	{
		$this->attributes['late_entry_time'] = \Carbon\Carbon::createFromFormat('h:i A',$value)->toTimeString();
	}

	public function getEarlyOutTimeAttribute($value)
	{ 
		return \Carbon\Carbon::createFromFormat('H:m:s', $value)->format('h:i A');
	}	

	public function setEarlyOutTimeAttribute($value)
	{
		$this->attributes['early_out_time'] = \Carbon\Carbon::createFromFormat('h:i A', $value)->toTimeString();
	}

 
}
