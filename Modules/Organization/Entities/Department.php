<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
	use SoftDeletes;


	protected $table = 'department';
	protected $fillable = ['department_name','description','location','branch_id','address','department_type_id'];

	public $timestamps=false;
	protected $dates = ['deleted_at'];
	
	public function department_type(){
		return $this->belongsTo('Modules\Organization\Entities\DepartmentType','department_type_id');
	}
	public function branch(){
		return $this->belongsTo('Modules\Organization\Entities\Branch','branch_id');
	}
}
