<?php

namespace Modules\Employee\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferLetterCreateRequest extends FormRequest
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
            'job_applicant_id'=>'required|exists:job_applicant,id',
            'department_branch_id'=>'required|exists:branch,id', 
            'department_id'=>'required|exists:department,id' ,
            'designation_id'=>'required|exists:designation,id' ,
            'offer_date'=>'required' ,
            'status'=>'required' , 
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
