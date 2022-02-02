@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.competenceregistration.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.competenceregistrations.update", [$competenceregistration->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.competenceregistration.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $competenceregistration->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.competenceregistration.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="competence_id">{{ trans('cruds.competenceregistration.fields.competence') }}</label>
                <select class="form-control select2 {{ $errors->has('competence') ? 'is-invalid' : '' }}" name="competence_id" id="competence_id" required>
                    @foreach($competences as $id => $entry)
                        <option value="{{ $id }}" {{ (old('competence_id') ? old('competence_id') : $competenceregistration->competence->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('competence'))
                    <span class="text-danger">{{ $errors->first('competence') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.competenceregistration.fields.competence_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="startdate">{{ trans('cruds.competenceregistration.fields.startdate') }}</label>
                <input class="form-control date {{ $errors->has('startdate') ? 'is-invalid' : '' }}" type="text" name="startdate" id="startdate" value="{{ old('startdate', $competenceregistration->startdate) }}">
                @if($errors->has('startdate'))
                    <span class="text-danger">{{ $errors->first('startdate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.competenceregistration.fields.startdate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="enddate">{{ trans('cruds.competenceregistration.fields.enddate') }}</label>
                <input class="form-control date {{ $errors->has('enddate') ? 'is-invalid' : '' }}" type="text" name="enddate" id="enddate" value="{{ old('enddate', $competenceregistration->enddate) }}">
                @if($errors->has('enddate'))
                    <span class="text-danger">{{ $errors->first('enddate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.competenceregistration.fields.enddate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="regnotes">{{ trans('cruds.competenceregistration.fields.regnotes') }}</label>
                <input class="form-control {{ $errors->has('regnotes') ? 'is-invalid' : '' }}" type="text" name="regnotes" id="regnotes" value="{{ old('regnotes', $competenceregistration->regnotes) }}">
                @if($errors->has('regnotes'))
                    <span class="text-danger">{{ $errors->first('regnotes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.competenceregistration.fields.regnotes_helper') }}</span>
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