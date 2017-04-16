<?php

namespace Modules\User\Repositories;

use Modules\User\Entities\Role;

class RoleRepository{
	public function getAllRoles($attribute, $value, $columns = ['*']){
		$role = Role::where($attribute, "LIKE", "%{$value}%")->get($columns);
    	return $role;
	}
	
}

?>