<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryHead extends Model
{
	use SoftDeletes;

	protected $table = 'salary_head';
	
	public $timestamps = false;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['salary_head_name','tax_type','acc_code', 'salary_head_type_id'];

 	public function salary_head_type(){ 
		return $this->belongsTo('Modules\Organization\Entities\SalaryHeadType','salary_head_type_id');
	}

	public function getTaxTypeAttribute($value)
	{ 
		if ($value==0) { 
			return 'Non Taxable';
		}
		return 'Taxable';
	}	
}
