<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
	use SoftDeletes;

	protected $table = 'branch';
	
	public $timestamps = false;
	
	protected $dates = ['deleted_at'];


	protected $fillable = ['branch_name','description','address','branch_type_id','district_id','post_office_id'];

	public function branch_type(){
		return $this->belongsTo('Modules\Organization\Entities\BranchType','branch_type_id');
	}

	public function district(){
		return $this->belongsTo('Modules\Organization\Entities\District','district_id');
	}

	public function post_office(){
		return $this->belongsTo('Modules\Organization\Entities\PostOffice','post_office_id');
	}
}
