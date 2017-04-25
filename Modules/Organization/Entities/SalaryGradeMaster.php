<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryGradeMaster extends Model
{
	use SoftDeletes;

	protected $table = 'salary_grade_master';
	
	public $timestamps = false;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['salary_grade_name', 'basic_salary'];

	public function salary_grade_info(){
		return $this->hasMany('Modules\Organization\Entities\SalaryGradeInfo');
	}
}
