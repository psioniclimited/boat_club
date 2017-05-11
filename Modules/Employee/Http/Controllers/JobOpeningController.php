<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 
use Modules\Employee\Entities\JobOpening;  
use \Modules\Helpers\DatatableHelper;
use Datatables;

class JobOpeningController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('employee::job_opening.job_opening_list');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('employee::job_opening.create_job_opening');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(\Modules\Employee\Http\Requests\JobOpenningCreateRequest $request){ 
       JobOpening::create($request->all());  
       $request->session()->flash('status', 'Task was successful!');
       return back();
   }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('employee::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(JobOpening $job_opening)
    {       
       return view('employee::job_opening.edit_job_opening',['job_opening'=>$job_opening]);
   }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Employee\Http\Requests\JobOpenningCreateRequest $request,JobOpening $job_opening)
    {
        $job_opening->update($request->all());
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/job_opening');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, JobOpening $job_opening)
    { 
        $job_opening->delete();
        $request->session()->flash('status', 'Task was successful!'); 
    }

    public function getAllJobOpenings(DatatableHelper $databaseHelper)
    { 
        $job_openings = JobOpening::all();  
        return Datatables::of($job_openings)
        ->addColumn('action', function ($job_openings) use ($databaseHelper){
            return $databaseHelper->editButton('job_opening',$job_openings->id).' '.$databaseHelper->deleteButton($job_openings->id);
        })
        ->make(true);
    }    
}
