<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanType extends Model
{
	use SoftDeletes;

	protected $table = 'loan_type';
	
	public $timestamps = true;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['loan_type_name','description','annual_interest_rate', 'active'];


}
