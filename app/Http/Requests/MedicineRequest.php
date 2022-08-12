<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineRequest extends FormRequest
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
            'image' => 'required',
            'par_code' => 'required|unique:products,par_code|max:15',
            'product_country' => 'required',
            'generic_name' => 'required|unique:medicines,generic_name|max:25',
            'medicine_name' => 'required|max:25',
            'privacy' => 'required',
        ];
    }
}
