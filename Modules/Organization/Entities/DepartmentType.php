<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;

class DepartmentType extends Model
{
	protected $table = 'department_type';
	protected $fillable = ['name'];
}
