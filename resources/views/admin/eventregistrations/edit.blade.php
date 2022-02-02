@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.eventregistration.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.eventregistrations.update", [$eventregistration->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.eventregistration.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $eventregistration->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventregistration.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="event_id">{{ trans('cruds.eventregistration.fields.event') }}</label>
                <select class="form-control select2 {{ $errors->has('event') ? 'is-invalid' : '' }}" name="event_id" id="event_id" required>
                    @foreach($events as $id => $entry)
                        <option value="{{ $id }}" {{ (old('event_id') ? old('event_id') : $eventregistration->event->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('event'))
                    <span class="text-danger">{{ $errors->first('event') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventregistration.fields.event_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="regnotes">{{ trans('cruds.eventregistration.fields.regnotes') }}</label>
                <input class="form-control {{ $errors->has('regnotes') ? 'is-invalid' : '' }}" type="text" name="regnotes" id="regnotes" value="{{ old('regnotes', $eventregistration->regnotes) }}">
                @if($errors->has('regnotes'))
                    <span class="text-danger">{{ $errors->first('regnotes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventregistration.fields.regnotes_helper') }}</span>
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