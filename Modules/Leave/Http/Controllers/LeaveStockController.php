<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Leave\Entities\LeaveLedger;
use Modules\Leave\Entities\LeaveStatus;
use Modules\Employee\Entities\EmployeeMaster;
use \Modules\Helpers\DatatableHelper;
use Datatables;
use DB;
use URL;
use Redirect;

class LeaveStockController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    { 
        return view('leave::leave_stock.leave_stock');
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
    // public function store(\Modules\Leave\Http\Requests\LeaveApplicationCreateRequest $request) 
    public function store(Request $request) 
    {    
        // dd($request->all());
        $employees_master=EmployeeMaster::find($request->employees_master_id);
        
        $employees_master->leave_stock()->delete();
        $employees_master->leave_stock()->createMany(json_decode($request->data,true));
        
        $request->session()->flash('status', 'Task was successful!');        
        return response()->json(['redirect' => URL::to('/leave_stock')], 200);
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
    public function edit(LeaveLedger $leave_application)
    {  
       
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Leave\Http\Requests\LeaveApplicationCreateRequest $request,LeaveLedger $leave_application)
    { 
 
    }

 
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {  
 
 
    }
    
 
    public function getLeaveRecord($employees_master_id){
        // dd($employees_master_id);
        $data=DB::table('leave_stock')
                ->where('leave_stock.deleted_at',NULL)
                ->where('leave_stock.employees_master_id',intval($employees_master_id))
                ->join('leave_type','leave_stock.leave_type_id','=','leave_type.id')
                ->select('leave_stock.number_of_days','leave_type.id','leave_type.leave_type_name');
 
        return Datatables::of($data)->make(true);                
    }
}

