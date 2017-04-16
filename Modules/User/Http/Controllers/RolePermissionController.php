<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Role;
use Modules\User\Entities\Permission;
use Modules\User\Repositories\RoleRepository;
class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('user::role_permission_index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {  

    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
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
        $permissions = Permission::all();  
        return view('user::edit_role_permission',['role'=>$role,'permissions'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, Role $role)
    { 
        $role->perms()->sync($request->permissions);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function getRoles(Request $request, RoleRepository $roleRepository)
    {
        return $roleRepository->getAllRoles('name', $request->input('term'), ['id', 'name as text']);
    }

}
