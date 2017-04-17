<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
	protected $table = 'district';
    protected $fillable = ['name','district_name'];
}
