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
use URL;

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
        return view('organization::leave_package.leave_package',['leave_types'=>$leave_types]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    // public function store(\Modules\Organization\Http\Requests\LeaveTypeCreateRequest $request)
    public function store(\Modules\Organization\Http\Requests\LeavePackageCreateRequest $request)
    {  
        $leave_package = LeavePackage::create($request->all());  
        $leave_package->leave_package_details()->createMany(json_decode($request->leave_package_details,true));

        $request->session()->flash('status', 'Task was successful!'); 
        return response()->json(['redirect' => URL::to('/leave_package/create')], 200);
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
    public function edit(LeavePackage $leave_package)
    {  






        $leave_types= LeaveType::orderBy('leave_type_name')->get(); 
        return view('organization::leave_package.edit_leave_package',
            [
            'leave_types'=>$leave_types,
            'leave_package'=>$leave_package
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\LeavePackageUpdateRequest $request,LeavePackage $leave_package)
    {
        $leave_package->update($request->all());
        
        $leave_package->leave_package_details()->delete(); 
        $leave_package->leave_package_details()->createMany(json_decode($request->leave_package_details,true));

        $request->session()->flash('status', 'Task was successful!'); 
        return response()->json(['redirect' => URL::to('/leave_package')], 200);

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(LeavePackage $leave_package,Request $request)
    { 
        $leave_package->delete();
        $request->session()->flash('status', 'Task was successful!');
        // return back();
    }
    


    public function getAllLeavePackages(DatatableHelper $databaseHelper)
    { 
        $leave_packages = LeavePackage::orderBy('leave_package_name'); 

        // return Datatables::of($leave_types)
        // ->addColumn('action', function ($branches) use ($databaseHelper){
        //     return $databaseHelper->editButton('branch',$branches->id).' '.$databaseHelper->deleteButton($branches->id);
        // })
        // ->make(true);

        return Datatables::of($leave_packages)
        ->addColumn('action', function ($leave_packages) use ($databaseHelper){
            return $databaseHelper->editButton('leave_package',$leave_packages->id);
        })
        ->make(true);
    }



}

