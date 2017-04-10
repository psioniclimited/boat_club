<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable = ['name','display_name','description'];
	protected $table = 'roles';
	public $timestamps = true;
	public function role_user()
	{
		return $this->hasMany('Modules\User\Entities\RoleUser');
	}
}