<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;
class EmployeeFamilyMembers extends Model
{
	use SoftDeletes;
	protected $table = 'employee_family_members';
	protected $fillable = ['family_member_name','date_of_birth','employees_master_id','family_relation_id'];
	public $timestamps=true;
	protected $dates = ['deleted_at'];

 
	public function family_relation()
	{  
		return $this->belongsTo('Modules\Employee\Entities\FamilyRelation','family_relation_id'); 
	}
 

}
