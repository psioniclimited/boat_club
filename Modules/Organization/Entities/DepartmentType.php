<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentType extends Model
{
	use SoftDeletes;
	
	protected $table = 'department_type';
	protected $fillable = ['department_type_name'];

	public $timestamps=false;
	protected $dates = ['deleted_at'];
	
	public function departments(){
		return $this->hasMany('Modules\Organization\Entities\Department');
	}
}
