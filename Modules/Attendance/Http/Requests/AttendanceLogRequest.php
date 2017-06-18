<?php

namespace Modules\Attendance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceLogRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */






    public function rules()
    {
        return [ 
        'employees_master_id'=>'exists:employees_master,id',  
        'working_date' => 'required',
        'time' => 'required', 
        'attendance_type' => 'required',
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
