<?php

namespace App\Http\Requests;

use App\Models\Prev;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePrevRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prev_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'prevtype' => [
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
            'rvtime' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'created_by_id' => [
                'required',
                'integer',
            ],
            'cares' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ambulancetransports' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
