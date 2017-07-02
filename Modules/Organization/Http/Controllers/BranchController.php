<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository;
use Modules\Organization\Entities\Branch;
use Modules\Organization\Entities\District;
use Modules\Organization\Entities\PostOffice;
use Modules\Organization\Entities\BranchType;
use \Modules\Helpers\DatatableHelper;
use Datatables;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('organization::branch.branch');
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
    public function store(\Modules\Organization\Http\Requests\BranchCreateRequest $request)
    { 
       $user = Branch::create($request->all());  
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
    public function edit(Branch $branch)
    { 
        $district=District::find($branch->id);
        return view('organization::branch.edit_branch',
            [
            'branch'=>$branch,
            'district'=>$district
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\BranchCreateRequest $request,Branch $branch)
    {
        $branch->update($request->all());
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/branch');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Branch $branch)
    { 
        $branch->delete();
        $request->session()->flash('status', 'Task was successful!');
        // return back();
    }
    


    public function getAllBranches(DatatableHelper $databaseHelper)
    { 
        $branches = Branch::all('branch_type','district','post_office'); 

        return Datatables::of($branches)
        ->addColumn('action', function ($branches) use ($databaseHelper){
            return $databaseHelper->editButton('branch',$branches->id).' '.$databaseHelper->deleteButton($branches->id);
        })
        ->make(true);
    }



}

