<?php

namespace App\Http\Requests;

use App\Models\Eventregistration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventregistrationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('eventregistration_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'event_id' => [
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
