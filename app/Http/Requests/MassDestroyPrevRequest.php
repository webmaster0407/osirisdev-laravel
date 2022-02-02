<?php

namespace App\Http\Requests;

use App\Models\Prev;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPrevRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('prev_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:prevs,id',
        ];
    }
}
