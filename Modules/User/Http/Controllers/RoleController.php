<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Entities\Role;
use Datatables;
use \Modules\Helpers\DatatableHelper;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('user::role');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(DatatableHelper $databaseHelper)
    {
        $roles = Role::all(); 
        return Datatables::of($roles)
        ->addColumn('action', function ($roles) use ($databaseHelper){
            return $databaseHelper->editButton('role',$roles->id).' '.$databaseHelper->deleteButton($roles->id);
        })
        ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(\Modules\User\Http\Requests\PermissionRequest $request)
    {
        $role = Role::create($request->all());
        return back();
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Role $role)
    {
        return view('user::edit_role',['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\User\Http\Requests\PermissionRequest $request,Role $role)
    { 
        $role->update($request->all());    
        return back();
    }


    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        Role::whereId($id)->delete();
    }
}
