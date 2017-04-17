<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;

class PostOffice extends Model
{
	protected $table = 'post_office';

	protected $fillable = ['postal_code','post_office_name','district_id'];

	public function district()
	{
		return $this->belongsTo('Modules\Organization\Entities\District', 'district_id');
	}
	public function branches(){
		return $this->hasMany('Modules\Organization\Entities\Branch');
	}
}
