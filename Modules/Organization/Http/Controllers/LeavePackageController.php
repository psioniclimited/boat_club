<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository;
use Modules\Organization\Entities\LeavePackage; 
use Modules\Organization\Entities\LeaveType; 
use Modules\Organization\Entities\LeavePackageDetails; 
use \Modules\Helpers\DatatableHelper;
use Datatables;

class LeavePackageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('organization::leave_package.leave_package_list');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        $leave_types= LeaveType::orderBy('leave_type_name')->get();
        // dd($leave_types[0]->leave_type_name);
        return view('organization::leave_package.leave_package',['leave_types'=>$leave_types]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    // public function store(\Modules\Organization\Http\Requests\LeaveTypeCreateRequest $request)
    public function store(Request $request)
    { 
        dd($request->all());
        // $leave_type = LeaveType::create($request->all());  
        // $request->session()->flash('status', 'Task was successful!');
        // return back();
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
    public function edit(LeaveType $leave_type)
    {  
        return view('organization::leave_type.edit_leave_type',['leave_type'=>$leave_type]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\LeaveTypeUpdateRequest $request,LeaveType $leave_type)
    {
        //initializing the row's checked colums as unchecked
        $leave_type->update(['carry_forward' => 0,'payment_type'=>0]);

        //now updating with given value
        $leave_type->update($request->all());

        $request->session()->flash('status', 'Task was successful!');
        return redirect('/leave_type');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(LeaveType $leave_type,Request $request)
    { 
        $leave_type->delete();
        $request->session()->flash('status', 'Task was successful!');
        // return back();
    }
    


    public function getAllLeaveTypes(DatatableHelper $databaseHelper)
    { 
        $leave_types = LeaveType::orderBy('leave_type_name'); 

        // return Datatables::of($leave_types)
        // ->addColumn('action', function ($branches) use ($databaseHelper){
        //     return $databaseHelper->editButton('branch',$branches->id).' '.$databaseHelper->deleteButton($branches->id);
        // })
        // ->make(true);

        return Datatables::of($leave_types)
        ->addColumn('action', function ($leave_types) use ($databaseHelper){
            return $databaseHelper->editButton('leave_type',$leave_types->id);
        })
        ->make(true);
    }



}

