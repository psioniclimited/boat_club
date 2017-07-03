<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveType extends Model
{
	use SoftDeletes;

	protected $table = 'leave_type';
	
	public $timestamps = true;
	
	protected $dates = ['deleted_at'];


	protected $fillable = ['leave_type_name','carry_forward','max_number_of_days','payment_type'];

}
