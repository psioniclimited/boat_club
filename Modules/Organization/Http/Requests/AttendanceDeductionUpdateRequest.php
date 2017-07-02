<?php

namespace Modules\Organization\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceDeductionUpdateRequest extends FormRequest
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
            //
            'deduction_policy_name'=>'required|unique:attendance_deduction_master,deduction_policy_name,'.$id, 
            'late_entry_day_count'=>'nullable|integer',
            'late_entry_deduction_day'=>'nullable|integer',
            'early_out_deduction_day'=>'nullable|integer',
            'early_out_day_count'=>'nullable|integer',
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
