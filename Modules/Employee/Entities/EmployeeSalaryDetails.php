<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;
class EmployeeSalaryDetails extends Model
{
	use SoftDeletes;

	protected $table = 'employee_salary_details';

	protected $fillable = ['amount','employee_salary_information_id','salary_head_id',];

	public $timestamps=true;

	protected $dates = ['deleted_at'];


	public function employee_salary_information(){
		return $this->belongsTo('Modules\Employee\Entities\EmployeeSalaryInformation','employee_salary_information_id'); 
	} 
	public function salary_head(){
		return $this->belongsTo('Modules\Organization\Entities\SalaryHead','salary_head_id'); 
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
