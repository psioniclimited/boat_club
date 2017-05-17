<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HolidayList extends Model
{
	use SoftDeletes;
	

	protected $table = 'holiday_list';
	public $timestamps = false;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['holiday_list_name'];

	public function holiday()
	{
		return $this->hasMany('Modules\Organization\Entities\Holiday');
	}

}
