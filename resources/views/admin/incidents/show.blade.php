@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.incident.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.incidents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.incident.fields.id') }}
                        </th>
                        <td>
                            {{ $incident->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incident.fields.name') }}
                        </th>
                        <td>
                            {{ $incident->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incident.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Incident::TYPE_SELECT[$incident->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incident.fields.description') }}
                        </th>
                        <td>
                            {!! $incident->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incident.fields.internalinfo') }}
                        </th>
                        <td>
                            {!! $incident->internalinfo !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incident.fields.date') }}
                        </th>
                        <td>
                            {{ $incident->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incident.fields.starttime') }}
                        </th>
                        <td>
                            {{ $incident->starttime }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incident.fields.endtime') }}
                        </th>
                        <td>
                            {{ $incident->endtime }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incident.fields.created_by') }}
                        </th>
                        <td>
                            {{ $incident->created_by->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incident.fields.resources') }}
                        </th>
                        <td>
                            @foreach($incident->resources as $key => $resources)
                                <span class="label label-info">{{ $resources->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.incident.fields.users') }}
                        </th>
                        <td>
                            @foreach($incident->users as $key => $users)
                                <span class="label label-info">{{ $users->firstname }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.incidents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection