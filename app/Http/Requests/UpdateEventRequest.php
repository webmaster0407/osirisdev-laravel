<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'type' => [
                'required',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'starttime' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'endtime' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'created_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
