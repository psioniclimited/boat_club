<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	protected $table = 'department';
	protected $fillable = ['name','description','location','branch_id','department_type_id'];}
