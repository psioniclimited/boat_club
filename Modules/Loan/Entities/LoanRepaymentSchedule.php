<?php

namespace Modules\Loan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanRepaymentSchedule extends Model
{
	use SoftDeletes;
	protected $table = 'loan_repayment_schedule';

	protected $fillable = ['payment_date','amount','loan_ledger_id'];

	public $timestamps=true;
	protected $dates = ['deleted_at'];

	
	public function loan_ledger(){
		return $this->belongsTo('Modules\Loan\Entities\LoanLedger','loan_ledger_id');
	}
	

	public function setPaymentDateAttribute($value)
	{     
		$date=date_create($value);  
		$this->attributes['payment_date'] = date_format($date,"Y-m-d");
	}

}
