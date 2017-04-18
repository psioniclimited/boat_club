<?php

namespace Modules\Organization\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostOfficeCreateRequet extends FormRequest
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
            'post_office_name'=>'required',
            'postal_code'=>'required|unique:post_office,postal_code',
            'district_id'=>'required|exists:district,id'
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
