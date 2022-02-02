@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.prev.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prevs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.id') }}
                        </th>
                        <td>
                            {{ $prev->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.name') }}
                        </th>
                        <td>
                            {{ $prev->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.prevtype') }}
                        </th>
                        <td>
                            {{ App\Models\Prev::PREVTYPE_SELECT[$prev->prevtype] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.description') }}
                        </th>
                        <td>
                            {!! $prev->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.internalinfo') }}
                        </th>
                        <td>
                            {!! $prev->internalinfo !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.date') }}
                        </th>
                        <td>
                            {{ $prev->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.starttime') }}
                        </th>
                        <td>
                            {{ $prev->starttime }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.endtime') }}
                        </th>
                        <td>
                            {{ $prev->endtime }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.rvtime') }}
                        </th>
                        <td>
                            {{ $prev->rvtime }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.location') }}
                        </th>
                        <td>
                            {{ $prev->location->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.created_by') }}
                        </th>
                        <td>
                            {{ $prev->created_by->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.papyrus') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $prev->papyrus ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.prima') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $prev->prima ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.prevresponsible') }}
                        </th>
                        <td>
                            {{ $prev->prevresponsible->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.amount') }}
                        </th>
                        <td>
                            {{ $prev->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.cares') }}
                        </th>
                        <td>
                            {{ $prev->cares }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.ambulancetransports') }}
                        </th>
                        <td>
                            {{ $prev->ambulancetransports }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.report') }}
                        </th>
                        <td>
                            {!! $prev->report !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prev.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Prev::STATUS_SELECT[$prev->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prevs.index') }}">
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
            <a class="nav-link" href="#prev_prevregistrations" role="tab" data-toggle="tab">
                {{ trans('cruds.prevregistration.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="prev_prevregistrations">
            @includeIf('admin.prevs.relationships.prevPrevregistrations', ['prevregistrations' => $prev->prevPrevregistrations])
        </div>
    </div>
</div>

@endsection