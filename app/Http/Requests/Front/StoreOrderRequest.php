<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',          
            "phone" => "required",
            "email" => "email|required",
           
           
            "address" => "required",
            
           
            "is_ur" => "a1",
            
            "ur_name" => "required_with:is_ur",
            "ur_inn" => "required_with:is_ur",
            "ur_nls" => "required_with:is_ur",
        ];
    }
}
