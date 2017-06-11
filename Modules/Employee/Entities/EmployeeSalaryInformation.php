<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;
class EmployeeSalaryInformation extends Model
{
	use SoftDeletes;

	protected $table = 'employee_salary_information';

	protected $fillable = ['basic_salary','hourly_pay_rate','overtime_rate','weekly_overtime_hour_limit','employee_job_info_id','employee_bank_name','employee_bank_branch','employee_bank_acc','final_leave_encashed','final_leave_encashed_date','payment_mode_id','salary_grade_master_id'];

	public $timestamps=true;

	protected $dates = ['deleted_at'];


	public function payment_mode(){
		return $this->belongsTo('Modules\Employee\Entities\PaymentMode','payment_mode_id'); 
	}

	public function employee_job_info(){
		return $this->belongsTo('Modules\Employee\Entities\EmployeeJobInfo','employee_job_info_id'); 
	}

	public function salary_grade_master(){
		return $this->belongsTo('Modules\Organization\Entities\SalaryGradeMaster','salary_grade_master_id'); 
	}
	
	public function employee_salary_details(){
		return $this->hasMany('Modules\Employee\Entities\EmployeeSalaryDetails','employee_salary_information_id'); 
	}
	

	// public function getCreatedAtAttribute($value)
	// {  
	// 	return (new \Carbon\Carbon($value))->toRfc1123String(); 
	// }

	// public function setResumeAttribute($value)
	// {    
	// 	if(!empty($value)){ 
	// 		$filename=uniqid('resume_').".".File::extension($value->getClientOriginalName());  
	// 		$value->move('uploads/resume', $filename);
	// 		$this->attributes['resume'] = $filename;
	// 	}
	// }

	// public function job_openings()
	// {  
	// 	return $this->belongsTo('Modules\Employee\Entities\JobOpening','job_openings_id'); 
	// }
	// public function job_applicant_status()
	// {  
	// 	return $this->belongsTo('Modules\Employee\Entities\JobApplicantStatus','job_applicant_status_id'); 
	// }
	// 	public function offer_letter()
	// {  
	// 	return $this->hasMany('Modules\Employee\Entities\OfferLetter'); 
	// }

}
