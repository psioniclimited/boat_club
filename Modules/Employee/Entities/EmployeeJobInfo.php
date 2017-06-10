<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;

class EmployeeJobInfo extends Model
{
	use SoftDeletes;

	protected $table = 'employee_job_info';

	protected $fillable = ['offer_date','confirmation_date','date_of_joining','retirement_date','contract_end_date','employees_master_id','department_id','department_branch_id','designation_id','company_email','notice_day','holiday_list_id','week_holiday_master_id','employment_type_id','resignation_offer_date','relieving_date','reason_for_leaving','new_workplace','feedback','work_shift_id','reporting_boss_id'];

	public $timestamps=true;

	protected $dates = ['deleted_at'];


	public function branch()
	{  
		return $this->belongsTo('Modules\Organization\Entities\Branch','department_branch_id'); 
	}

	public function department()
	{  
		return $this->belongsTo('Modules\Organization\Entities\Department','department_id'); 
	}
	
	public function designation()
	{  
		return $this->belongsTo('Modules\Organization\Entities\Designation','designation_id'); 
	}
	public function work_shift()
	{  
		return $this->belongsTo('Modules\Organization\Entities\WorkShift','work_shift_id'); 
	}
	public function holiday_list()
	{  
		return $this->belongsTo('Modules\Organization\Entities\HolidayList','holiday_list_id'); 
	}
	
	public function week_holiday_master()
	{  
		return $this->belongsTo('Modules\Organization\Entities\WeekHolidayMaster','week_holiday_master_id'); 
	}

	public function employees_master()
	{  
		return $this->belongsTo('Modules\Employee\Entities\EmployeeMaster','employees_master_id'); 
	}
	
	public function employment_type()
	{  
		return $this->belongsTo('Modules\Employee\Entities\EmploymentType','employment_type_id'); 
	}

	public function employee_salary_information()
	{  
		return $this->hasMany('Modules\Employee\Entities\EmployeeSalaryInformation'); 
	}



	public function setResignationOfferDateAttribute($value)
	{     
		$date=date_create($value);  
		$this->attributes['resignation_offer_date'] = date_format($date,"Y-m-d");
	}
	public function setRelievingDateAttribute($value)
	{     
		$date=date_create($value);  
		$this->attributes['relieving_date'] = date_format($date,"Y-m-d");
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
