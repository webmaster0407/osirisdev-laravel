@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.competence.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.competences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.competence.fields.id') }}
                        </th>
                        <td>
                            {{ $competence->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competence.fields.key') }}
                        </th>
                        <td>
                            {{ $competence->key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competence.fields.name') }}
                        </th>
                        <td>
                            {{ $competence->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competence.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Competence::TYPE_SELECT[$competence->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competence.fields.color') }}
                        </th>
                        <td>
                            {{ $competence->color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competence.fields.expirable') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $competence->expirable ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.competences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
