<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'name' => 'required|max:250',
            'description' => 'max:250|nullable',
            'category' => 'required|max:50',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'paymentMode' => 'required|max:50',
            'vendor_id' => 'required',
        ];
    }
}
