@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.task.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tasks.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="createduser_id">{{ trans('cruds.task.fields.createduser') }}</label>
                <select class="form-control select2 {{ $errors->has('createduser') ? 'is-invalid' : '' }}" name="createduser_id" id="createduser_id">
                    @foreach($createdusers as $id => $entry)
                        <option value="{{ $id }}" {{ old('createduser_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('createduser'))
                    <span class="text-danger">{{ $errors->first('createduser') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.createduser_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assigneduser_id">{{ trans('cruds.task.fields.assigneduser') }}</label>
                <select class="form-control select2 {{ $errors->has('assigneduser') ? 'is-invalid' : '' }}" name="assigneduser_id" id="assigneduser_id">
                    @foreach($assignedusers as $id => $entry)
                        <option value="{{ $id }}" {{ old('assigneduser_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigneduser'))
                    <span class="text-danger">{{ $errors->first('assigneduser') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.assigneduser_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.task.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('completed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="completed" value="0">
                    <input class="form-check-input" type="checkbox" name="completed" id="completed" value="1" {{ old('completed', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="completed">{{ trans('cruds.task.fields.completed') }}</label>
                </div>
                @if($errors->has('completed'))
                    <span class="text-danger">{{ $errors->first('completed') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.completed_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="relationtype">{{ trans('cruds.task.fields.relationtype') }}</label>
                <input class="form-control {{ $errors->has('relationtype') ? 'is-invalid' : '' }}" type="text" name="relationtype" id="relationtype" value="{{ old('relationtype', '') }}">
                @if($errors->has('relationtype'))
                    <span class="text-danger">{{ $errors->first('relationtype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.relationtype_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="relationid">{{ trans('cruds.task.fields.relationid') }}</label>
                <input class="form-control {{ $errors->has('relationid') ? 'is-invalid' : '' }}" type="number" name="relationid" id="relationid" value="{{ old('relationid', '') }}" step="1">
                @if($errors->has('relationid'))
                    <span class="text-danger">{{ $errors->first('relationid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.relationid_helper') }}</span>
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