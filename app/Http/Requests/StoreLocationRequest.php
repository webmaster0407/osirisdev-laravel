<?php

namespace App\Http\Requests;

use App\Models\Location;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLocationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('location_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'street' => [
                'string',
                'nullable',
            ],
            'number' => [
                'string',
                'nullable',
            ],
            'zip' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'city' => [
                'string',
                'nullable',
            ],
            'created_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
