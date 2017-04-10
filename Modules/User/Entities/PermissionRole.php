<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{ 
	protected $table = 'permissions';
	public $timestamps = false;
	public function permissions()
	{
		return $this->belongsTo('Modules\User\Entities\Permission');
	}
	public function roles()
	{
		return $this->belongsTo('Modules\User\Entities\Role');
	}

}