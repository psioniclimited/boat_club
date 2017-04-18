<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
	protected $table = 'district';

	protected $fillable = ['district_name'];

	public $timestamps=false;

	
	public function post_offices(){
		return $this->hasMany('Modules\Organization\Entities\PostOffice');
	}

	public function branches(){
		return $this->hasMany('Modules\Organization\Entities\Branch');
	}
}
