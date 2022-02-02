@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.prevregistration.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prevregistrations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.prevregistration.fields.id') }}
                        </th>
                        <td>
                            {{ $prevregistration->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prevregistration.fields.user') }}
                        </th>
                        <td>
                            {{ $prevregistration->user->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prevregistration.fields.prev') }}
                        </th>
                        <td>
                            {{ $prevregistration->prev->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prevregistration.fields.regnotes') }}
                        </th>
                        <td>
                            {{ $prevregistration->regnotes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prevregistrations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection