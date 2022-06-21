<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'item_name' => ['required','max:50'],
            'item_description' => ['required','max:300'],
            'item_place' => ['required','max:50'],
            'item_price' => ['required','integer','min:0'],
            'category_id' => [
                'required','exists:categories,id'
                ],
            'item_image' => [
                'file',
                'image',
                'mimes:jpeg,jpg,png',
                'dimensions:min_width=50,min_height=50,max_width=5000,max_height=5000',
                ],
            
        ];
    }
}
