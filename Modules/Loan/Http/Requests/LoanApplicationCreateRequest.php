<?php

namespace Modules\Loan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanApplicationCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {        
        return [
            // 
        'loan_status_id'=> 'required|exists:loan_status,id', 
        'loan_type_id'=> 'required|exists:loan_type,id', 
        'employees_master_id'=> 'required|exists:employees_master,id', 
        'required_by_date'=> 'required', 
        'monthly_repayment_amount'=> 'required|numeric|min:0', 
        'annual_interest_rate'=> 'required|numeric|min:0', 
        'loan_amount'=> 'required|numeric|min:0', 
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
