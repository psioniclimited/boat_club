<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Entities\Permission;
use Datatables;
use \Modules\Helpers\DatatableHelper;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('user::permission');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(DatatableHelper $databaseHelper)
    { 
        $permissions = Permission::all(); 
        return Datatables::of($permissions)
        ->addColumn('action', function ($permissions) use ($databaseHelper){
            return $databaseHelper->editButton('permission',$permissions->id).' '.$databaseHelper->deleteButton($permissions->id);
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
        $permission = Permission::create($request->all());
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
    public function edit(Permission $permission)
    { 
        return view('user::edit_permission',['permission'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\User\Http\Requests\PermissionRequest $request,Permission $permission)
    { 
        $permission->update($request->all());    
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete(); 
    }
}
