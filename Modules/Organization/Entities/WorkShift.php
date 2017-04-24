<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkShift extends Model
{
	use SoftDeletes;

	protected $table = 'work_shift';
	
	public $timestamps = false;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['shift_name','start_from','end_to', 'time_duration'];


	public function getStartFromAttribute($value)
	{ 
		return \Carbon\Carbon::createFromFormat('H:m:s', $value)->format('h:i A');
	}

	public function setStartFromAttribute($value)
	{
		$this->attributes['start_from'] = \Carbon\Carbon::createFromFormat('h:i A',$value)->toTimeString();
	}

	public function getEndToAttribute($value)
	{ 
		return \Carbon\Carbon::createFromFormat('H:m:s', $value)->format('h:i A');
	}	

	public function setEndToAttribute($value)
	{
		$this->attributes['end_to'] = \Carbon\Carbon::createFromFormat('h:i A', $value)->toTimeString();
	}

	
	public function setTimeDurationAttribute($value){
		$start_from = new \Carbon\Carbon($this->attributes['start_from']);
		$end_to = new \Carbon\Carbon($this->attributes['end_to']);
		$time_diff = $start_from->diffInMinutes($end_to);
		$this->attributes['time_duration'] = $time_diff;

	}
}
