<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|max:250|unique:projects,title,' . $this->id,
            'description' => 'max:500|nullable',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'billingType' => 'max:50|nullable',
            'cost' => 'numeric|nullable',
            'estHours' => 'numeric|nullable',
            'tag' => 'max:50|nullable',
            'status' => 'required|max:50',
            'client_id' => 'required',
        ];
    }
}
