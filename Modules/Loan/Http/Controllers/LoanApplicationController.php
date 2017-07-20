<?php

namespace Modules\Loan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository;
use Modules\Loan\Entities\LoanStatus;  
use Modules\Loan\Entities\LoanApplication; 
use \Modules\Helpers\DatatableHelper;
use Datatables;

use DB;

class LoanApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('loan::loan_application.list_of_loan_applications');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('loan::loan_application.create_loan_application',['loan_status'=>LoanStatus::all()]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(\Modules\Loan\Http\Requests\LoanApplicationCreateRequest $request) 
    {    
       $loan_application = LoanApplication::create($request->all());  
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
    public function edit(LoanApplication $loan_application)
    {   
        return view('loan::loan_application.edit_loan_application',['loan_status'=>LoanStatus::all(),'loan_application'=>$loan_application]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Loan\Http\Requests\LoanApplicationCreateRequest $request, LoanApplication $loan_application)
    {

        if (!$this->isChangebale($loan_application)) { 
            return redirect()->back()->with('alert-class', 'You can not Change as a Decision has been made on this Application');
        }

        $loan_application->update($request->all());  
        $request->session()->flash('status', 'Task was successful!');
        return back();  
    }



    public function isChangebale($loan_application)
    { 
        if ($loan_application->loan_status->change_type==1) {
            return true;
        }
        else{
            return false;
        }
    }





    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, LoanApplication $loan_application)
    {  
       
        if (!$this->isChangebale($loan_application)) {  
            $request->session()->flash('alert-class',  'You can not Change as a Decision has been made on this Application');
        } 
        $loan_application->delete();
        $request->session()->flash('status', 'Task was successful!');
        
    }
    


    public function getAllApplications(DatatableHelper $databaseHelper)
    {  
     $loan_application=DB::table('loan_application')
     ->join('employees_master','employees_master.id','=','loan_application.employees_master_id')
     ->where('loan_application.deleted_at', '=', NULL)   
     ->join('loan_type','loan_type.id','=','loan_application.loan_type_id')
     ->join('loan_status','loan_status.id','=','loan_application.loan_status_id')
     ->select('loan_application.*','employees_master.employee_fullname','employees_master.contact_number','employees_master.employee_code',,'loan_status.loan_status_name','loan_type.loan_type_name');

     return Datatables::of($loan_application)
     ->addColumn('action', function ($loan_application) use ($databaseHelper){
        return $databaseHelper->editButton('loan_application',$loan_application->id).' '.$databaseHelper->deleteButton($loan_application->id);
    })
     ->make(true);



 }



}

