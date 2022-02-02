<?php

namespace App\Http\Requests;

use App\Models\Eventregistration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEventregistrationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('eventregistration_create');
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
