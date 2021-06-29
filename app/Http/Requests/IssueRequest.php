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
            'type' => 'required|max:50',
            'severity' => 'required|max:50',
            'flag' => 'required|max:50',
            'dueDate' => 'required|date',
            'status' => 'required|max:50',
            'tag' => 'max:50|nullable',
            'user_id' => 'required',
            'project_id' => 'required',
            'assignee_id' => 'required',
        ];
    }
}
