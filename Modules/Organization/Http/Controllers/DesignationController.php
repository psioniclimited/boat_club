<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository; 
use Modules\Organization\Entities\Designation;  
use \Modules\Helpers\DatatableHelper;
use Datatables;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('organization::designation.designation');
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
    public function store(\Modules\Organization\Http\Requests\DesignationCreateRequest $request){
       Designation::create($request->all());  
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
    public function edit(Designation $designation)
    {       
       return view('organization::designation.edit_designation',
        [
        'designation'=>$designation
        ]);
   }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\DesignationCreateRequest $request,Designation $designation)
    {
        $designation->update($request->all());
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/designation');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, Designation $designation)
    { 
        $designation->delete();
        $request->session()->flash('status', 'Task was successful!'); 
    }

    public function getAllDesignations(DatatableHelper $databaseHelper)
    { 
        $designation = Designation::all(); 
        
        return Datatables::of($designation)
        ->addColumn('action', function ($designation) use ($databaseHelper){
            return $databaseHelper->editButton('designation',$designation->id).' '.$databaseHelper->deleteButton($designation->id);
        })
        ->make(true);
    }    
}
