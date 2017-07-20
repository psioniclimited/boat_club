<?php

namespace Modules\Loan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanApplication extends Model
{
	use SoftDeletes;
	protected $table = 'loan_application';
	protected $fillable = ['loan_amount','annual_interest_rate','required_by_date','monthly_repayment_amount','reason','loan_status_id','employees_master_id','loan_type_id','disbursed'];

	public $timestamps=true;
	protected $dates = ['deleted_at'];

	public function loan_status(){
		return $this->belongsTo('Modules\Loan\Entities\LoanStatus','loan_status_id');
	}

	public function employees_master(){
		return $this->belongsTo('Modules\Employee\Entities\EmployeeMaster','employees_master_id');
	}

	public function loan_type(){
		return $this->belongsTo('Modules\Organization\Entities\LoanType','loan_type_id');
	}

	public function setRequiredByDateAttribute($value)
	{     
		$date=date_create($value);  
		$this->attributes['required_by_date'] = date_format($date,"Y-m-d");
	}

}
