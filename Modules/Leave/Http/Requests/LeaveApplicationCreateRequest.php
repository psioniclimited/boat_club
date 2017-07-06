<?php

namespace Modules\Leave\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveApplicationCreateRequest extends FormRequest
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
            'leave_type_id'=>'required|exists:leave_type,id', 
            'employees_master_id'=>'required|exists:employees_master,id',
            'from_date'=>'required',
            'to_date'=>'required',
            'reason'=>'required', 
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
