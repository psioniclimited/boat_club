<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;
class JobApplicant extends Model
{
	use SoftDeletes;
	protected $table = 'job_applicant';
	protected $fillable = ['applicant_name','applicant_email','applicant_contact',
	'cover_letter','resume','job_openings_id','job_applicant_status_id'];
	public $timestamps=true;
	protected $dates = ['deleted_at'];

	public function getCreatedAtAttribute($value)
	{  
		return (new \Carbon\Carbon($value))->toRfc1123String(); 
	}

	public function setResumeAttribute($value)
	{    
		if(!empty($value)){ 
			$filename=uniqid('resume_').".".File::extension($value->getClientOriginalName());  
			$value->move('uploads/resume', $filename);
			$this->attributes['resume'] = $filename;
		}
	}

	public function job_openings()
	{  
		return $this->belongsTo('Modules\Employee\Entities\JobOpening','job_openings_id'); 
	}
	public function job_applicant_status()
	{  
		return $this->belongsTo('Modules\Employee\Entities\JobApplicantStatus','job_applicant_status_id'); 
	}
}
