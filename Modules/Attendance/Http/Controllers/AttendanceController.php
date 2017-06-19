<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Attendance\Entities\AttendanceLog; 
use DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    { 
        return view('attendance::attendance.attendance_single');
    }

    public function bulkAttendance()
    { 
        return view('attendance::attendance.attendance_bulk');
    }

        /**
     * Display the punch in view
     * @return Response
     */
        public function punchInIndex()
        {
        // dd("jaks");

        }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('attendance::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(\Modules\Attendance\Http\Requests\AttendanceLogRequest $request)
    {
        $data=$request->all(); 
        $this->insertInDatabase($data,$request);
 
        $request->session()->flash('status', 'Task was successful!');
        return redirect()->back();
    }


    public function storeBulkAttendance(\Modules\Attendance\Http\Requests\AttendanceLogRequest $request)
    {
        // dd($request->all());
        $employees=$request->employees_master_id;
        foreach ($employees as $key => $value) { 
            $data=$request->all(); 
            $data['employees_master_id']=$value;
            $this->insertInDatabase($data,$request);
        }

        $request->session()->flash('status', 'Task was successful!');
        return redirect()->back();
    }



    public function insertInDatabase($data,$request){

    // if attendance type is log in then just create new instance of attendance log
     if ($request->attendance_type==1) { 
        $data['punch_in_time']=$request->time; 
    }else{
        $data['punch_out_time']=$request->time;
    }




    //first check if the user has punched in on that day
    // if yes then update the punch out time of that day
    // else create new instance with punch out time 
    $existing_data=$this->checkExistingData($data); 

    if ($existing_data->isEmpty()) {  
        AttendanceLog::create($data);
    }else{ 
        $existing_data[0]->update($data);
    }
}


public function checkExistingData($data){  
    $existing_data=AttendanceLog::where('employees_master_id','=',$data['employees_master_id'])
    ->where('working_date','=',$data['working_date'])
    ->get();

    return $existing_data;
}


    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('attendance::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('attendance::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }


    public function getEmployees(Request $request)
    {
        // dd($request->all());

        // $data = DB::table('employees_master')
        // ->select('employees_master.id','employees_master.employee_fullname','employees_master.employee_code')
        // ->orderBy('employees_master.employee_fullname', 'ASC')
        // ->join('employee_job_info', 'employee_job_info.employees_master_id', '=', 'employees_master.id') 
        
        // ->leftJoin('attendance_log', 'attendance_log.employees_master_id', '=', 'employees_master.id')  
        
        // ->where('attendance_log.working_date','=',$request->working_date)

        // ->where('employees_master.employee_status','=',1 )
        // ->where('employee_job_info.department_id','=',$request->department_id ) 
        // ->get();

        $data = DB::table('employees_master')
        ->select('employees_master.id','employees_master.employee_fullname','employees_master.employee_code','attendance_log.punch_in_time','attendance_log.punch_out_time')
        ->orderBy('employees_master.employee_fullname', 'ASC')
        ->join('employee_job_info', 'employee_job_info.employees_master_id', '=', 'employees_master.id') 
        
        ->leftJoin('attendance_log', function($query) use ($request){
            $query->on('attendance_log.employees_master_id', '=', 'employees_master.id');
            $query->where('attendance_log.working_date', '=', $request->working_date);
        })   
        ->where('employees_master.employee_status','=',1 )
        ->where('employee_job_info.department_id','=',$request->department_id ) 
        ->get();

        // dd($data);
        return response()->json($data);

    }

}
