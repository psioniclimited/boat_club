<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Organization\Repositories\BranchRepository;
use Modules\Organization\Entities\LoanType;

use \Modules\Helpers\DatatableHelper;
use Datatables;


class LoanTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('organization::loan_type.list_of_loan_types');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('organization::loan_type.create_loan_type');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(\Modules\Organization\Http\Requests\LoanTypeCreateRequest $request)
    {  
        $loan_type = LoanType::create($request->all());  
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
    public function edit(LoanType $loan_type)
    { 
        // dd($loan_type); 
        return view('organization::loan_type.edit_loan_type', ['loan_type'=>$loan_type]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\LoanTypeUpdateRequest $request,LoanType $loan_type)
    {
        //default action for active status 
        $loan_type->update(['active'=>1]);
        $loan_type->update($request->all());
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/loan_type');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request,LoanType $loan_type)
    {  
        $branch->delete();
        $request->session()->flash('status', 'Task was successful!');
    }
    


    public function getAllLoanTypes(DatatableHelper $databaseHelper)
    { 
        $loan_types = LoanType::all(); 

        return Datatables::of($loan_types)
        ->addColumn('action', function ($loan_types) use ($databaseHelper){
            return $databaseHelper->editButton('loan_type',$loan_types->id).' '.$databaseHelper->deleteButton($loan_types->id);
        })
        ->make(true);
    }



}

