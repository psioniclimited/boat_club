<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository; 
use Modules\Organization\Entities\Department;  
use \Modules\Helpers\DatatableHelper;
use Datatables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('organization::department.department');
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
    public function store(\Modules\Organization\Http\Requests\DepartmentCreateRequest $request){
       Department::create($request->all());  
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
    public function edit(Department $department)
    {       
       return view('organization::department.edit_department',
        [
        'department'=>$department
        ]);
   }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\DepartmentCreateRequest $request,Department $department)
    {
        $department->update($request->all());
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/department');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, Department $department)
    { 
        $department->delete();
        $request->session()->flash('status', 'Task was successful!'); 
    }

    public function getAllDepartments(DatatableHelper $databaseHelper)
    { 
        $department = Department::with('branch','department_type'); 
        
        return Datatables::of($department)
        ->addColumn('action', function ($department) use ($databaseHelper){
            return $databaseHelper->editButton('department',$department->id).' '.$databaseHelper->deleteButton($department->id);
        })
        ->make(true);
    }    
}
