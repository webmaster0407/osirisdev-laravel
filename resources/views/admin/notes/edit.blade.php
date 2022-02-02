@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.note.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notes.update", [$note->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="userid_id">{{ trans('cruds.note.fields.userid') }}</label>
                <select class="form-control select2 {{ $errors->has('userid') ? 'is-invalid' : '' }}" name="userid_id" id="userid_id" required>
                    @foreach($userids as $id => $entry)
                        <option value="{{ $id }}" {{ (old('userid_id') ? old('userid_id') : $note->userid->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('userid'))
                    <span class="text-danger">{{ $errors->first('userid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.note.fields.userid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="note">{{ trans('cruds.note.fields.note') }}</label>
                <input class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" type="text" name="note" id="note" value="{{ old('note', $note->note) }}" required>
                @if($errors->has('note'))
                    <span class="text-danger">{{ $errors->first('note') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.note.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="relationtype">{{ trans('cruds.note.fields.relationtype') }}</label>
                <input class="form-control {{ $errors->has('relationtype') ? 'is-invalid' : '' }}" type="text" name="relationtype" id="relationtype" value="{{ old('relationtype', $note->relationtype) }}" required>
                @if($errors->has('relationtype'))
                    <span class="text-danger">{{ $errors->first('relationtype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.note.fields.relationtype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="relationid">{{ trans('cruds.note.fields.relationid') }}</label>
                <input class="form-control {{ $errors->has('relationid') ? 'is-invalid' : '' }}" type="number" name="relationid" id="relationid" value="{{ old('relationid', $note->relationid) }}" step="1" required>
                @if($errors->has('relationid'))
                    <span class="text-danger">{{ $errors->first('relationid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.note.fields.relationid_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.note.fields.visability') }}</label>
                <select class="form-control {{ $errors->has('visability') ? 'is-invalid' : '' }}" name="visability" id="visability">
                    <option value disabled {{ old('visability', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Note::VISABILITY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('visability', $note->visability) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('visability'))
                    <span class="text-danger">{{ $errors->first('visability') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.note.fields.visability_helper') }}</span>
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