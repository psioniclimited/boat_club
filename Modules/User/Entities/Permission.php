<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $fillable = ['name','display_name','description'];
	protected $table = 'permissions';
	public $timestamps = true;
	public function permission_role()
	{
		return $this->hasMany('Modules\User\Entities\PermissionRole');
	}
}