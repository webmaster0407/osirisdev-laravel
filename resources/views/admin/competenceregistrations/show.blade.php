@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.competenceregistration.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.competenceregistrations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.competenceregistration.fields.id') }}
                        </th>
                        <td>
                            {{ $competenceregistration->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competenceregistration.fields.user') }}
                        </th>
                        <td>
                            {{ $competenceregistration->user->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competenceregistration.fields.competence') }}
                        </th>
                        <td>
                            {{ $competenceregistration->competence->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competenceregistration.fields.startdate') }}
                        </th>
                        <td>
                            {{ $competenceregistration->startdate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competenceregistration.fields.enddate') }}
                        </th>
                        <td>
                            {{ $competenceregistration->enddate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competenceregistration.fields.regnotes') }}
                        </th>
                        <td>
                            {{ $competenceregistration->regnotes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.competenceregistrations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection