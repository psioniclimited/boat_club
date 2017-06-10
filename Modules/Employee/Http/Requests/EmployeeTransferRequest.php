<?php

namespace Modules\Employee\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeTransferRequest extends FormRequest
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
            'employees_master_id'=>'required|exists:employees_master,id',
            'department_branch_id'=>'required|exists:branch,id', 
            'department_id'=>'required|exists:department,id', 
            'designation_id'=>'required|exists:designation,id', 
            'work_shift_id'=>'required|exists:work_shift,id' ,
            'holiday_list_id'=>'required|exists:holiday_list,id' ,
            'week_holiday_master_id'=>'required|exists:week_holiday_master,id' 
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
