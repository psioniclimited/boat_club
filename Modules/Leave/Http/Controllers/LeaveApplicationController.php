<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Organization\Repositories\BranchRepository;
use Modules\Organization\Entities\AttendanceDeductionMaster;
use \Modules\Helpers\DatatableHelper;
use Datatables;


class LeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('Leave::leave_application.list_of_leave_applications');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('Leave::leave_application.create_leave_application');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(\Modules\Organization\Http\Requests\AttendanceDeductionCreateRequest $request)
    {   
        $user = AttendanceDeductionMaster::create($request->all());
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
    public function edit(AttendanceDeductionMaster $attendance_deduction)
    {  
        return view('organization::attendance_deduction.edit_attendance_deduction',['attendance_deduction'=>$attendance_deduction]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\AttendanceDeductionUpdateRequest $request,AttendanceDeductionMaster $attendance_deduction)
    {
        $attendance_deduction->update($request->all()); 
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/attendance_deduction');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(AttendanceDeductionMaster $attendance_deduction,Request $request)
    { 
        // dd($attendance_deduction);
        $attendance_deduction->delete();
        $request->session()->flash('status', 'Task was successful!');
        // return back();
    }
    


    public function getAllDeductionPolicies(DatatableHelper $databaseHelper)
    { 
        $deduction_policies = AttendanceDeductionMaster::orderBy('deduction_policy_name')->get(); 

        return Datatables::of($deduction_policies)
        ->addColumn('action', function ($deduction_policies) use ($databaseHelper){
            return $databaseHelper->editButton('attendance_deduction',$deduction_policies->id).' '.$databaseHelper->deleteButton($deduction_policies->id);
        })
        ->make(true);
    }



}

