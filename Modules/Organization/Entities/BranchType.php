<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;

class BranchType extends Model
{
	protected $table = 'branch_type';
	protected $fillable = ['name'];

	public function branches(){
		return $this->hasMany('Modules\Organization\Entities\Branch');
	}
}