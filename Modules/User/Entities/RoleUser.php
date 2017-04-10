<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{ 
	protected $table = 'role_user';
	public $timestamps = false;
	public function role()
	{
		return $this->belongsTo('Modules\User\Entities\Role');
	}
	public function user()
	{
		return $this->belongsTo('Modules\User\Entities\User');
	}	
}