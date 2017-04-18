<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository;
use Modules\Organization\Entities\BranchType;  
use \Modules\Helpers\DatatableHelper;
use Datatables;
class BranchTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('organization::branch_type.branch_type');
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
    public function store(\Modules\Organization\Http\Requests\BranchTypeCreateRequest $request)
    {          
        $branch_type = BranchType::create($request->all());  
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
    public function edit(BranchType $branch_type)
    {  
        return view('organization::branch_type.edit_branch_type',
            [
            'branch_type'=>$branch_type
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\BranchTypeCreateRequest $request,BranchType $branch_type)
    { 
        $branch_type->update($request->all());
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/branch_type');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, BranchType $branch_type)
    { 
        // dd($district);
        $branch_type->delete();
        $request->session()->flash('status', 'Task was successful!');
        // return back(); 
    }
    


    public function getAllBranchTypes(DatatableHelper $databaseHelper)
    { 
        $branch_type = BranchType::all(); 
        return Datatables::of($branch_type)
        ->addColumn('action', function ($branch_type) use ($databaseHelper){
            return $databaseHelper->editButton('branch_type',$branch_type->id).' '.$databaseHelper->deleteButton($branch_type->id);
        })
        ->make(true);
    }



}

