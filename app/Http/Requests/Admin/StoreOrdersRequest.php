<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrdersRequest extends FormRequest
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
            'name' => 'min:3|max:50|required',
            'email' => 'required|email',
            'phone' => 'min:5|max:50|required',
            'address' => 'min:5|max:255',
            'time' => 'date_format:H:i',
            
           
        ];
    }
}
