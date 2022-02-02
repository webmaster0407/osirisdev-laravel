@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.resource.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.resources.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.resource.fields.id') }}
                        </th>
                        <td>
                            {{ $resource->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resource.fields.name') }}
                        </th>
                        <td>
                            {{ $resource->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resource.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Resource::TYPE_SELECT[$resource->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resource.fields.idtag') }}
                        </th>
                        <td>
                            {{ $resource->idtag }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.resources.index') }}">
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
            <a class="nav-link" href="#resources_incidents" role="tab" data-toggle="tab">
                {{ trans('cruds.incident.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="resources_incidents">
            @includeIf('admin.resources.relationships.resourcesIncidents', ['incidents' => $resource->resourcesIncidents])
        </div>
    </div>
</div>

@endsection