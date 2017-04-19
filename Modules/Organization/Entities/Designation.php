<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
	use SoftDeletes;
	
	protected $table = 'designation';

	protected $fillable = ['designation_name'];

	public $timestamps=false;
	protected $dates = ['deleted_at'];

}
