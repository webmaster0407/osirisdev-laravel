<?php

namespace App\Http\Requests;

use App\Models\Resource;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateResourceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('resource_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'type' => [
                'required',
            ],
            'idtag' => [
                'string',
                'nullable',
            ],
        ];
    }
}
