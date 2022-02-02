@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.comlog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.comlogs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="from">{{ trans('cruds.comlog.fields.from') }}</label>
                <input class="form-control {{ $errors->has('from') ? 'is-invalid' : '' }}" type="text" name="from" id="from" value="{{ old('from', '') }}">
                @if($errors->has('from'))
                    <span class="text-danger">{{ $errors->first('from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comlog.fields.from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="to">{{ trans('cruds.comlog.fields.to') }}</label>
                <input class="form-control {{ $errors->has('to') ? 'is-invalid' : '' }}" type="text" name="to" id="to" value="{{ old('to', '') }}">
                @if($errors->has('to'))
                    <span class="text-danger">{{ $errors->first('to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comlog.fields.to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subject">{{ trans('cruds.comlog.fields.subject') }}</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="subject" id="subject" value="{{ old('subject', '') }}">
                @if($errors->has('subject'))
                    <span class="text-danger">{{ $errors->first('subject') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comlog.fields.subject_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="message">{{ trans('cruds.comlog.fields.message') }}</label>
                <input class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" type="text" name="message" id="message" value="{{ old('message', '') }}">
                @if($errors->has('message'))
                    <span class="text-danger">{{ $errors->first('message') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comlog.fields.message_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.comlog.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Comlog::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comlog.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="extrainfo">{{ trans('cruds.comlog.fields.extrainfo') }}</label>
                <input class="form-control {{ $errors->has('extrainfo') ? 'is-invalid' : '' }}" type="text" name="extrainfo" id="extrainfo" value="{{ old('extrainfo', '') }}">
                @if($errors->has('extrainfo'))
                    <span class="text-danger">{{ $errors->first('extrainfo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comlog.fields.extrainfo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.comlog.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comlog.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection