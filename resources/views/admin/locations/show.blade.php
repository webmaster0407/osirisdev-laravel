@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.location.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.locations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.location.fields.id') }}
                        </th>
                        <td>
                            {{ $location->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.location.fields.name') }}
                        </th>
                        <td>
                            {{ $location->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.location.fields.street') }}
                        </th>
                        <td>
                            {{ $location->street }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.location.fields.number') }}
                        </th>
                        <td>
                            {{ $location->number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.location.fields.zip') }}
                        </th>
                        <td>
                            {{ $location->zip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.location.fields.city') }}
                        </th>
                        <td>
                            {{ $location->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.location.fields.description') }}
                        </th>
                        <td>
                            {!! $location->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.location.fields.created_by') }}
                        </th>
                        <td>
                            {{ $location->created_by->firstname ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.locations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#location_prevs" role="tab" data-toggle="tab">
                {{ trans('cruds.prev.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#location_events" role="tab" data-toggle="tab">
                {{ trans('cruds.event.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="location_prevs">
            @includeIf('admin.locations.relationships.locationPrevs', ['prevs' => $location->locationPrevs])
        </div>
        <div class="tab-pane" role="tabpanel" id="location_events">
            @includeIf('admin.locations.relationships.locationEvents', ['events' => $location->locationEvents])
        </div>
    </div>
</div>

@endsection