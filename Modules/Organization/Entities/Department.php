<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	protected $table = 'department';
	protected $fillable = ['department_name','description','location','branch_id','department_type_id'];

	public function department_type(){
		return $this->belongsTo('Modules\Organization\Entities\DepartmentType','department_type_id');
	}
}
