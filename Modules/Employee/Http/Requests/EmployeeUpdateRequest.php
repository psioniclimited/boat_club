<?php

namespace Modules\Employee\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */



 


    public function rules()
    {
         $id=$this->input('id'); 
        return [
            
            'employee_code'=>'unique:employees_master,employee_code,'.$id,  
            'employee_fullname' => 'required',
            'employee_image' => 'mimes:jpg,jpeg,png',
            'contact_number' => 'required',
            'date_of_birth' => 'required',
            'marital_status_id' => 'required',
            'religion_id' => 'required',
            'blood_group_id' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'date_of_joining' => 'required',
            'retirement_date' => 'required',
            'employment_type_id' => 'required',
            'basic_salary' => 'required',
            'payment_mode_id' => 'required',
            'final_leave_encashed' => 'required',
            'salary_grade_master_id' => 'required',
            'department_branch_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'holiday_list_id' => 'required',
            'week_holiday_master_id' => 'required'
        
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
