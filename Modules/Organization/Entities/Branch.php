<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
	protected $table = 'branch';
    protected $fillable = ['name','description','branch_type_id','district_id','post_office_id'];
}
