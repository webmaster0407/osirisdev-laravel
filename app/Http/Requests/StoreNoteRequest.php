<?php

namespace App\Http\Requests;

use App\Models\Note;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNoteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('note_create');
    }

    public function rules()
    {
        return [
            'userid_id' => [
                'required',
                'integer',
            ],
            'note' => [
                'string',
                'required',
            ],
            'relationtype' => [
                'string',
                'required',
            ],
            'relationid' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
