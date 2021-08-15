<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'subject' => 'required|max:250',
            'description' => 'max:500|nullable',
            'priority' => 'required|max:50',
            'status' => 'required|max:50',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'project_id' => 'required',
            'collaborator_id' => 'required',
        ];
    }
}
