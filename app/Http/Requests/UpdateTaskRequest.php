<?php

namespace App\Http\Requests;

use App\Models\Task;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_edit');
    }

    public function rules()
    {
        return [
            'description' => [
                'string',
                'nullable',
            ],
            'relationtype' => [
                'string',
                'nullable',
            ],
            'relationid' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
