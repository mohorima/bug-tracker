<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'name' => 'required|max:250|unique:vendors,name,' . $this->id,
            'address' => 'required|max:250',
            'city' => 'required|max:100',
            'state' => 'required|max:50',
            'zip' => 'required|max:10',
            'country' => 'required|max:50',
            'contactPerson' => 'max:100|nullable',
            'email' => 'required|max:100|email',
            'phone' => 'required|digits_between:5,20',
            'website' => 'max:350|nullable',
        ];
    }
}
