<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model; 
class PaymentMode extends Model
{ 
	protected $table = 'payment_mode'; 
	public $timestamps=false;  
	
	public function employee_salary_information()
	{   
		return $this->hasMany('Modules\Employee\Entities\EmployeeSalaryInformation'); 
	}
	

}
