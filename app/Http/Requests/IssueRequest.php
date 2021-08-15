<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IssueRequest extends FormRequest
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
            'title' => 'required|max:250',
            'description' => 'nullable|max:250',
            'type' => 'required|max:50',
            'severity' => 'required|max:50',
            'dueDate' => 'required|date',
            'status' => 'required|max:50',
            'project_id' => 'required',
            'assignee_id' => 'required',
        ];
    }
}
