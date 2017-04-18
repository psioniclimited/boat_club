<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchType extends Model
{
	use SoftDeletes;
	protected $table = 'branch_type';
	protected $fillable = ['branch_type_name'];

	public $timestamps=false;
	protected $dates = ['deleted_at'];

	public function branches(){
		return $this->hasMany('Modules\Organization\Entities\Branch');
	}
}
