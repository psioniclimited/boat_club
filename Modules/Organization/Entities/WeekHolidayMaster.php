<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeekHolidayMaster extends Model
{
	use SoftDeletes;

	protected $table = 'week_holiday_master';
	
	public $timestamps = false;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['week_holiday_master_name'];


	public function week_holiday()
	{ 
		return $this->hasMany('Modules\Organization\Entities\WeekHoliday','week_holiday_master_id');
	}
}
