<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeavePackage extends Model
{
	use SoftDeletes;

	protected $table = 'leave_package';
	
	public $timestamps = true;
	
	protected $dates = ['deleted_at'];


	protected $fillable = ['leave_package_name','description'];

	public function leave_package_details(){
		return $this->hasMany('Modules\Organization\Entities\LeavePackageDetails','leave_package_id');
	}

}
