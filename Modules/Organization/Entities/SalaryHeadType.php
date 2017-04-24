<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryHeadType extends Model
{
	use SoftDeletes;

	protected $table = 'salary_head_type';
	
	public $timestamps = false;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['type_name','head_type'];

 	public function salary_heads(){ 
		return $this->hasMany('Modules\Organization\Entities\SalaryHead');
	}

}
