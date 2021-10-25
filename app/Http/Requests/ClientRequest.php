<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
            'company' => [
                'required',
                'max:250',
                Rule::unique('clients')->ignore($this->id),
            ],
            'owner' => 'max:100|nullable',
            'address' => 'required|max:250',
            'country' => 'required|max:50',
            'contactPerson' => 'max:100|nullable',
            'email' => 'required|max:100|email',
            'phone' => 'required|digits_between:5,20',
            'website' => 'max:250|nullable',
        ];
    }
}
