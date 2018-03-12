<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductsRequest extends FormRequest
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
            'price_original' => 'required',
            'category_id' => 'required',
            'articul' => 'min:6|max:6|required|regex:/[\d]{2}\.[\d]{3}/|unique:products,articul,'.$this->route('product'),
            'amount' => 'max:1000',
           // 'specifications.*' => 'exists:specifications,id',
        ];
    }
}
