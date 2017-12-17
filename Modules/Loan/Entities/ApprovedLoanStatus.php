<?php

namespace Modules\Loan\Entities;

use Illuminate\Database\Eloquent\Model;
 
class ApprovedLoanStatus extends Model
{
 	protected $table = 'approved_loan_status';
 
 	public $timestamps=false; 

	public function loan_ledger(){
		return $this->hasmany('Modules\Loan\Entities\LoanLedger','approved_loan_status_id');
	}
 
}
