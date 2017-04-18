<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PostOffice extends Model
{
		use SoftDeletes;
	protected $table = 'post_office';

	protected $fillable = ['postal_code','post_office_name','district_id'];


	public $timestamps=false;
	protected $dates = ['deleted_at'];

	public function district()
	{
		return $this->belongsTo('Modules\Organization\Entities\District', 'district_id');
	}
	public function branches(){
		return $this->hasMany('Modules\Organization\Entities\Branch');
	}
}
