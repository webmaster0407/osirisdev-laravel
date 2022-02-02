@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.note.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.note.fields.id') }}
                        </th>
                        <td>
                            {{ $note->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.note.fields.userid') }}
                        </th>
                        <td>
                            {{ $note->userid->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.note.fields.note') }}
                        </th>
                        <td>
                            {{ $note->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.note.fields.relationtype') }}
                        </th>
                        <td>
                            {{ $note->relationtype }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.note.fields.relationid') }}
                        </th>
                        <td>
                            {{ $note->relationid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.note.fields.visability') }}
                        </th>
                        <td>
                            {{ App\Models\Note::VISABILITY_SELECT[$note->visability] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection