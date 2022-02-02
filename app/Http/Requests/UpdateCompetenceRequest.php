<?php

namespace App\Http\Requests;

use App\Models\Competence;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCompetenceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('competence_edit');
    }

    public function rules()
    {
        return [
            'key' => [
                'string',
                'required',
                'unique:competences,key,' . request()->route('competence')->id,
            ],
            'name' => [
                'string',
                'required',
            ],
            'type' => [
                'required',
            ],
            'color' => [
                'string',
                'required',
                'unique:competences,color,' . request()->route('competence')->id,
            ],
        ];
    }
}
