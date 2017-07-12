<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;
class EmployeeMaster extends Model
{
	use SoftDeletes;

	protected $table = 'employees_master';
	protected $primaryKey = 'id';

	protected $fillable = ['employee_code','employee_fullname','gender','date_of_birth','tin_no','nid','contact_number',
	'employee_status','employee_image','present_address','permanent_address','passport','passport_issue_date','passport_valid_upto','passport_issue_place','personal_email','emergency_contact_name','emergency_contact_relation','emergency_contact_number','health_details','bio','employee_series_id','blood_group_id','marital_status_id','religion_id','can_login','salutation_id'];

	public $timestamps=true;

	protected $dates = ['deleted_at'];


	public function employee_series(){
		return $this->belongsTo('Modules\Employee\Entities\EmployeeSeries','employee_series_id'); 
	}

	public function salutation(){
		return $this->belongsTo('Modules\Employee\Entities\Salutation','salutation_id'); 
	}

	public function religion(){
		return $this->belongsTo('Modules\Employee\Entities\Religion','religion_id'); 
	}
	public function blood_group(){
		return $this->belongsTo('Modules\Employee\Entities\BloodGroup','blood_group_id'); 
	}

	public function marital_status(){
		return $this->belongsTo('Modules\Employee\Entities\MaritalStatus','marital_status_id'); 
	}


	public function employee_family_members(){
		return $this->hasMany('Modules\Employee\Entities\EmployeeFamilyMembers', 'employees_master_id'); 
	}

	public function employee_work_history_inside_company(){
		return $this->hasMany('Modules\Employee\Entities\EmployeeWorkHistoryInCompany','employees_master_id'); 
	}

	public function employee_educational_background(){
		return $this->hasMany('Modules\Employee\Entities\EmployeeEducationalBackground','employees_master_id'); 
	}

	public function employee_previous_job_experience(){
		return $this->hasMany('Modules\Employee\Entities\EmployeePreviousJobExperience','employees_master_id'); 
	}
	
	public function employee_job_info(){
		return $this->hasMany('Modules\Employee\Entities\EmployeeJobInfo','employees_master_id'); 
	}
	public function leave_stock(){
		return $this->hasMany('Modules\Leave\Entities\LeaveStock','employees_master_id'); 
	}



	public function setEmployeeImageAttribute($value)
	{    
		if(!empty($value)){ 
			$filename=uniqid('employee_').".".File::extension($value->getClientOriginalName());  
			$value->move('uploads/employee_image', $filename);
			$this->attributes['employee_image'] = $filename;
		}
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
