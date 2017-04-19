<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository; 
use Modules\Organization\Entities\DepartmentType;  
use \Modules\Helpers\DatatableHelper;
use Datatables;

class DepartmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('organization::department_type.department_type');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('organization::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(\Modules\Organization\Http\Requests\DepartmentTypeCreateRequest $request){
       DepartmentType::create($request->all());  
       $request->session()->flash('status', 'Task was successful!');
       return back();
   }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('organization::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(DepartmentType $department_type)
    {       
       return view('organization::department_type.edit_department_type',
        [
        'department_type'=>$department_type
        ]);
   }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\DepartmentTypeCreateRequest $request,DepartmentType $department_type)
    {
        $department_type->update($request->all());
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/department_type');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, DepartmentType $department_type)
    { 
        $department_type->delete();
        $request->session()->flash('status', 'Task was successful!'); 
    }

    public function getAllDepartmentTypes(DatatableHelper $databaseHelper)
    { 
        $department_type = DepartmentType::all(); 
        
        return Datatables::of($department_type)
        ->addColumn('action', function ($department_type) use ($databaseHelper){
            return $databaseHelper->editButton('department_type',$department_type->id).' '.$databaseHelper->deleteButton($department_type->id);
        })
        ->make(true);
    }    
}
