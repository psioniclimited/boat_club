<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeekHoliday extends Model
{
	use SoftDeletes;

	protected $table = 'week_holiday';
	
	public $timestamps = false;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['week_holiday_master_id','day_name_id'];


	public function week_holiday_master()
	{ 
		return $this->belongsTo('Modules\Organization\Entities\WeekHolidayMaster','week_holiday_master_id');
	}
		public function day_name()
	{ 
		return $this->belongsTo('Modules\Organization\Entities\DayName','day_name_id');
	}
}
