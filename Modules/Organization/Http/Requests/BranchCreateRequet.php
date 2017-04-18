<?php

namespace Modules\Organization\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchCreateRequet extends FormRequest
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
            'branch_name'=>'required',
            'branch_type_id'=>'required|exists:branch_type,id',
            'district_id'=>'required|exists:district,id',
            'post_office_id'=>'required|exists:post_office,id',
            'address'=>'required'
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
