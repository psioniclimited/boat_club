<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository; 
use Modules\Organization\Entities\SalaryHead;  
use Modules\Organization\Entities\SalaryHeadType;  
use \Modules\Helpers\DatatableHelper;
use Datatables;

class SalaryHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $salary_head_type=SalaryHeadType::all();
        return view('organization::salary_head.salary_head',['salary_head_type'=>$salary_head_type]);
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
    public function store(\Modules\Organization\Http\Requests\SalaryHeadCreateRequest $request){
     SalaryHead::create($request->all());  
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
    public function edit(SalaryHead $salary_head,SalaryHeadType $salary_head_type)
    {         
     return view('organization::salary_head.edit_salary_head',
        [
        'salary_head'=>$salary_head,
        'salary_head_type'=>SalaryHeadType::all()
        ]);
 }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\SalaryHeadCreateRequest $request,SalaryHead $salary_head)
    {
        $salary_head->update($request->all());
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/salary_head');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, SalaryHead $salary_head)
    { 
        $salary_head->delete();
        $request->session()->flash('status', 'Task was successful!'); 
    }

    public function getAllSalaryHeads(DatatableHelper $databaseHelper)
    { 
        $salary_head = SalaryHead::with('salary_head_type'); 
        
        return Datatables::of($salary_head)
        ->addColumn('action', function ($salary_head) use ($databaseHelper){
            return $databaseHelper->editButton('salary_head',$salary_head->id).' '.$databaseHelper->deleteButton($salary_head->id);
        })
        ->make(true);
    }    
}
