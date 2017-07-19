<?php

namespace Modules\Loan\Entities;

use Illuminate\Database\Eloquent\Model;
 
class LoanStatus extends Model
{ 
	protected $table = 'loan_status';
 
	public $timestamps=false;
 
	public function loan_application(){
		return $this->hasMany('Modules\Loan\Entities\LoanApplication','loan_status_id');
	}
	
}
