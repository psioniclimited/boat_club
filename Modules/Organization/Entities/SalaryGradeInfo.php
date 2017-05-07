<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryGradeInfo extends Model
{
	use SoftDeletes;


	protected $table = 'salary_grade_info';
	
	public $timestamps = false;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['amount', 'salary_grade_master_id','salary_head_id','amount_type'];

	public function salary_grade_master(){
		return $this->belongsTo('Modules\Organization\Entities\SalaryGradeMaster','salary_grade_master_id');
	}

	public function salary_head(){
		return $this->belongsTo('Modules\Organization\Entities\SalaryHead','salary_head_id');
	}

	public function getLastNameAttribute()
    {
        return ucfirst($value);
    }
}
