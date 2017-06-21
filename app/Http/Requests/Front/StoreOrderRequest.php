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
        return true;
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
           "agreement"=>"accepted",
            'time' => 'date_format:H:i',
            "address" => "required",
            
           
           
            
            "ur_name" => "required_with:is_ur",
            "ur_inn" => "required_with:is_ur|numeric",
            "ur_nls" => "required_with:is_ur|numeric",
        ];
    }
}
