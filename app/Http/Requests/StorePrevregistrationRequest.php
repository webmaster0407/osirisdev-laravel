<?php

namespace App\Http\Requests;

use App\Models\Prevregistration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePrevregistrationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prevregistration_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'prev_id' => [
                'required',
                'integer',
            ],
            'regnotes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
