<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOpening extends Model
{
	use SoftDeletes;
	protected $table = 'job_openings';
	protected $fillable = ['job_title','description','job_opening_status'];

	public $timestamps=true;
	protected $dates = ['deleted_at'];

	public function getCreatedAtAttribute($value)
	{  
		return (new \Carbon\Carbon($value))->toRfc1123String(); 
	}

 
}
