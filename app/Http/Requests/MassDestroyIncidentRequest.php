<?php

namespace App\Http\Requests;

use App\Models\Incident;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIncidentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('incident_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:incidents,id',
        ];
    }
}
