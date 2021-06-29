<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'billDate' => 'required|date',
            'dueDate' => 'required|date',
            'tax' => 'required|numeric',
            'recurring' => 'required|boolean',
            'note' => 'max:250|nullable',
            'tag' => 'max:50|nullable',
            'project_id' => 'required',
        ];
    }
}
