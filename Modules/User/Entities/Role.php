<?php

namespace Modules\User\Entities;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{	
	protected $fillable = [
	'name', 'display_name','description'
	];
	
}