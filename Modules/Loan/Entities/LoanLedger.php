<?php

namespace Modules\Loan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanLedger extends Model
{
	use SoftDeletes;
	protected $table = 'loan_ledger';

	protected $fillable = ['principal_loan_amount','annual_interest_rate','interest_amount','balance_loan_amount',

	'disbursement_date','monthly_repayment_amount','unique_loan_id','approved_loan_status_id','employees_master_id','loan_type_id'];

	public $timestamps=true;
	protected $dates = ['deleted_at'];

	public function approved_loan_status(){
		return $this->belongsTo('Modules\Loan\Entities\ApprovedLoanStatus','approved_loan_status_id');
	}

	public function employees_master(){
		return $this->belongsTo('Modules\Employee\Entities\EmployeeMaster','employees_master_id');
	}

	public function loan_type(){
		return $this->belongsTo('Modules\Organization\Entities\LoanType','loan_type_id');
	}

	public function loan_application(){
		return $this->belongsTo('Modules\Loan\Entities\LoanApplication','loan_application_id');
	}

	public function loan_repayment_schedule(){
		return $this->hasMany('Modules\Organization\Entities\LoanRepaymentSchedule','loan_ledger_id');
	}

	public function setDisbursementDateAttribute($value)
	{     
		$date=date_create($value);  
		$this->attributes['disbursement_date'] = date_format($date,"Y-m-d");
	}

}
