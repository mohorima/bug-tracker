<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'company' => 'required|max:250|unique:clients,company,' . $this->id,
            'owner' => 'max:100|nullable',
            'address' => 'required|max:250',
            'city' => 'required|max:100',
            'state' => 'required|max:50',
            'zip' => 'required|max:10',
            'country' => 'required|max:50',
            'contactPerson' => 'max:100|nullable',
            'email' => 'required|max:100|email',
            'phone' => 'required|digits_between:5,20',
            'clientGroup' => 'required|max:50',
            'vatNumber' => 'max:15|nullable',
            'billingAddress' => 'max:250|nullable',
            'billingCity' => 'max:100|nullable',
            'billingState' => 'max:50|nullable',
            'billingZip' => 'max:10|nullable',
            'billingCountry' => 'max:50|nullable',
        ];
    }
}
