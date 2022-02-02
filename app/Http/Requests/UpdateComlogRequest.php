<?php

namespace App\Http\Requests;

use App\Models\Comlog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateComlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('comlog_edit');
    }

    public function rules()
    {
        return [
            'from' => [
                'string',
                'nullable',
            ],
            'to' => [
                'string',
                'nullable',
            ],
            'subject' => [
                'string',
                'nullable',
            ],
            'message' => [
                'string',
                'nullable',
            ],
            'extrainfo' => [
                'string',
                'nullable',
            ],
        ];
    }
}
