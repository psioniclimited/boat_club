<?php
namespace Modules\Helpers;
use Form;
class DatatableHelper{
	public function editButton($id){
		return '<a href="' . url('/').'/user/' . $id.'/edit" class="btn btn-sm btn-info" title="edit"><i class="glyphicon glyphicon-edit"></i>
	</a>';
}

public function deleteButton($id){
	return '<a class="btn btn-sm btn-danger" id="'.$id.'"
               data-toggle="modal" data-target="#confirm_delete">
               <i class="glyphicon glyphicon-trash"></i> 
           </a>';
}
}