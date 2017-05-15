<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferLetter extends Model
{
	use SoftDeletes;
	protected $table = 'offer_letters';
	protected $fillable = ['offer_date','department_id','department_branch_id','designation_id','terms_and_conditions'];

	public $timestamps=true;
	protected $dates = ['deleted_at'];

	public function getCreatedAtAttribute($value)
	{  
		return (new \Carbon\Carbon($value))->toRfc1123String(); 
	}
	
	public function getOfferDateAttribute($value)
	{  
		return (new \Carbon\Carbon($value))->toRfc1123String(); 
	}
	
	public function department()
	{  
		return $this->belongsTo('Modules\Organization\Entities\Department','department_id'); 
	}

	public function branch()
	{  
		return $this->belongsTo('Modules\Organization\Entities\Branch','department_branch_id'); 
	}

	public function designation()
	{  
		return $this->belongsTo('Modules\Organization\Entities\Designation','designation_id'); 
	}


}
