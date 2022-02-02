@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.comlog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comlogs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.comlog.fields.id') }}
                        </th>
                        <td>
                            {{ $comlog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comlog.fields.from') }}
                        </th>
                        <td>
                            {{ $comlog->from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comlog.fields.to') }}
                        </th>
                        <td>
                            {{ $comlog->to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comlog.fields.subject') }}
                        </th>
                        <td>
                            {{ $comlog->subject }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comlog.fields.message') }}
                        </th>
                        <td>
                            {{ $comlog->message }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comlog.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Comlog::TYPE_SELECT[$comlog->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comlog.fields.extrainfo') }}
                        </th>
                        <td>
                            {{ $comlog->extrainfo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comlog.fields.user') }}
                        </th>
                        <td>
                            {{ $comlog->user->firstname ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comlogs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection