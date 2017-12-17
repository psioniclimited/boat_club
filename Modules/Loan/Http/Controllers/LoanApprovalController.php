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

class LoanApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        return view('loan::loan_approval.list_of_loan_applications_for_approval');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    { 
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request) 
    {     
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
    public function edit(LoanApplication $loan_approval)
    {   
        return view('loan::loan_approval.edit_loan_application_for_approval',['loan_status'=>LoanStatus::all(),'loan_application'=>$loan_approval]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, LoanApplication $loan_approval)
    {

        if ($this->has_been_disbursed($loan_approval)) { 
            return redirect()->back()->with('alert-class', 'You can not Change as it has already beeen disbursed');
        }  

        $loan_approval->update($request->all());  
        
        if ($loan_approval->loan_status->loan_ledger_entry==1) { 
            if (empty($loan_approval->loan_ledger)) { 
                return redirect()->route('loan_ledger.create', ['loan_application_id' => $loan_approval->id]);
            }else{
               $request->session()->flash('status', 'Loan entry has already been created!');
               return back();  
           }
       }

       $request->session()->flash('status', 'Task was successful!');
       return back();  
   }



   public function has_been_disbursed($loan_application)
   { 
    if ($loan_application->disbursed==1) {
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
    public function destroy(Request $request, LoanApplication $loan_approval)
    {  

        if ($this->has_been_disbursed->isChangebale($loan_approval)) {  
            $request->session()->flash('alert-class',  'You can not Change as a Decision has been made on this Application');
        } 
        $loan_approval->delete();
        $request->session()->flash('status', 'Task was successful!');
        
    }
    


    public function getAllApplications(DatatableHelper $databaseHelper)
    {  
     $loan_application=DB::table('loan_application')
     ->join('employees_master','employees_master.id','=','loan_application.employees_master_id')
     ->where('loan_application.deleted_at', '=', NULL)   
     ->where('loan_application.disbursed', '=', 0)   
     ->join('loan_type','loan_type.id','=','loan_application.loan_type_id')
     ->join('loan_status','loan_status.id','=','loan_application.loan_status_id')
     ->select('loan_application.*','employees_master.employee_fullname','employees_master.contact_number','employees_master.employee_code','loan_status.loan_status_name','loan_type.loan_type_name');

     return Datatables::of($loan_application)
     ->addColumn('action', function ($loan_application) use ($databaseHelper){
        return $databaseHelper->editButton('loan_approval',$loan_application->id);
    })
     ->make(true);



 }



}

