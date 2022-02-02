@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.incident.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.incidents.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.incident.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incident.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.incident.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Incident::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', 'MIP') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incident.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.incident.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incident.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internalinfo">{{ trans('cruds.incident.fields.internalinfo') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('internalinfo') ? 'is-invalid' : '' }}" name="internalinfo" id="internalinfo">{!! old('internalinfo') !!}</textarea>
                @if($errors->has('internalinfo'))
                    <span class="text-danger">{{ $errors->first('internalinfo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incident.fields.internalinfo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.incident.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incident.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="starttime">{{ trans('cruds.incident.fields.starttime') }}</label>
                <input class="form-control timepicker {{ $errors->has('starttime') ? 'is-invalid' : '' }}" type="text" name="starttime" id="starttime" value="{{ old('starttime') }}">
                @if($errors->has('starttime'))
                    <span class="text-danger">{{ $errors->first('starttime') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incident.fields.starttime_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="endtime">{{ trans('cruds.incident.fields.endtime') }}</label>
                <input class="form-control timepicker {{ $errors->has('endtime') ? 'is-invalid' : '' }}" type="text" name="endtime" id="endtime" value="{{ old('endtime') }}">
                @if($errors->has('endtime'))
                    <span class="text-danger">{{ $errors->first('endtime') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incident.fields.endtime_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="created_by_id">{{ trans('cruds.incident.fields.created_by') }}</label>
                <select class="form-control select2 {{ $errors->has('created_by') ? 'is-invalid' : '' }}" name="created_by_id" id="created_by_id" required>
                    @foreach($created_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('created_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('created_by'))
                    <span class="text-danger">{{ $errors->first('created_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incident.fields.created_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="resources">{{ trans('cruds.incident.fields.resources') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('resources') ? 'is-invalid' : '' }}" name="resources[]" id="resources" multiple>
                    @foreach($resources as $id => $resource)
                        <option value="{{ $id }}" {{ in_array($id, old('resources', [])) ? 'selected' : '' }}>{{ $resource }}</option>
                    @endforeach
                </select>
                @if($errors->has('resources'))
                    <span class="text-danger">{{ $errors->first('resources') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incident.fields.resources_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="users">{{ trans('cruds.incident.fields.users') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="users[]" id="users" multiple>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ in_array($id, old('users', [])) ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('users'))
                    <span class="text-danger">{{ $errors->first('users') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incident.fields.users_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.incidents.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $incident->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection