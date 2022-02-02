<?php

namespace App\Http\Requests;

use App\Models\Competenceregistration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCompetenceregistrationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('competenceregistration_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'competence_id' => [
                'required',
                'integer',
            ],
            'startdate' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'enddate' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'regnotes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
