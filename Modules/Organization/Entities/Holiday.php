<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holiday extends Model
{
	use SoftDeletes;
 	
	public $timestamps = false;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['description','holiday_date'];

}
