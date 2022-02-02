@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.prevregistration.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.prevregistrations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.prevregistration.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prevregistration.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="prev_id">{{ trans('cruds.prevregistration.fields.prev') }}</label>
                <select class="form-control select2 {{ $errors->has('prev') ? 'is-invalid' : '' }}" name="prev_id" id="prev_id" required>
                    @foreach($prevs as $id => $entry)
                        <option value="{{ $id }}" {{ old('prev_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('prev'))
                    <span class="text-danger">{{ $errors->first('prev') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prevregistration.fields.prev_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="regnotes">{{ trans('cruds.prevregistration.fields.regnotes') }}</label>
                <input class="form-control {{ $errors->has('regnotes') ? 'is-invalid' : '' }}" type="text" name="regnotes" id="regnotes" value="{{ old('regnotes', '') }}">
                @if($errors->has('regnotes'))
                    <span class="text-danger">{{ $errors->first('regnotes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prevregistration.fields.regnotes_helper') }}</span>
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