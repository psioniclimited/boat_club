<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeavePackageDetails extends Model
{
	use SoftDeletes;

	protected $table = 'leave_package_details';
	
	public $timestamps = true;
	
	protected $dates = ['deleted_at'];


	protected $fillable = ['number_of_days','leave_package_id','leave_type_id'];

	public function leave_package(){
		return $this->belongsTo('Modules\Organization\Entities\LeavePackage','leave_package_id');
	}

	public function leave_type(){
		return $this->belongsTo('Modules\Organization\Entities\LeaveType','leave_type_id');
	}

}
