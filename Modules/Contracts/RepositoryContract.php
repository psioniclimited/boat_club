<?php
namespace Modules\Contracts;

 

interface RepositoryContract
{
    public function all($attribute, $value, $columns = ['*']);
    public function find($id, $columns = array('*'));
}