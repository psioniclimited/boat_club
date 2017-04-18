<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
	use SoftDeletes;
	
	protected $table = 'district';

	protected $fillable = ['district_name'];

	public $timestamps=false;
	protected $dates = ['deleted_at'];

	
	public function post_offices(){
		return $this->hasMany('Modules\Organization\Entities\PostOffice');
	}

	public function branches(){
		return $this->hasMany('Modules\Organization\Entities\Branch');
	}
}
