@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.resource.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.resources.update", [$resource->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.resource.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $resource->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resource.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.resource.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Resource::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $resource->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resource.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="idtag">{{ trans('cruds.resource.fields.idtag') }}</label>
                <input class="form-control {{ $errors->has('idtag') ? 'is-invalid' : '' }}" type="text" name="idtag" id="idtag" value="{{ old('idtag', $resource->idtag) }}">
                @if($errors->has('idtag'))
                    <span class="text-danger">{{ $errors->first('idtag') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resource.fields.idtag_helper') }}</span>
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