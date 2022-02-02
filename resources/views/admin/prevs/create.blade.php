@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.prev.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.prevs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.prev.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.prev.fields.prevtype') }}</label>
                <select class="form-control {{ $errors->has('prevtype') ? 'is-invalid' : '' }}" name="prevtype" id="prevtype" required>
                    <option value disabled {{ old('prevtype', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Prev::PREVTYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('prevtype', 'local') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('prevtype'))
                    <span class="text-danger">{{ $errors->first('prevtype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.prevtype_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.prev.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internalinfo">{{ trans('cruds.prev.fields.internalinfo') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('internalinfo') ? 'is-invalid' : '' }}" name="internalinfo" id="internalinfo">{!! old('internalinfo') !!}</textarea>
                @if($errors->has('internalinfo'))
                    <span class="text-danger">{{ $errors->first('internalinfo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.internalinfo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.prev.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="starttime">{{ trans('cruds.prev.fields.starttime') }}</label>
                <input class="form-control timepicker {{ $errors->has('starttime') ? 'is-invalid' : '' }}" type="text" name="starttime" id="starttime" value="{{ old('starttime') }}">
                @if($errors->has('starttime'))
                    <span class="text-danger">{{ $errors->first('starttime') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.starttime_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="endtime">{{ trans('cruds.prev.fields.endtime') }}</label>
                <input class="form-control timepicker {{ $errors->has('endtime') ? 'is-invalid' : '' }}" type="text" name="endtime" id="endtime" value="{{ old('endtime') }}">
                @if($errors->has('endtime'))
                    <span class="text-danger">{{ $errors->first('endtime') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.endtime_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rvtime">{{ trans('cruds.prev.fields.rvtime') }}</label>
                <input class="form-control timepicker {{ $errors->has('rvtime') ? 'is-invalid' : '' }}" type="text" name="rvtime" id="rvtime" value="{{ old('rvtime') }}">
                @if($errors->has('rvtime'))
                    <span class="text-danger">{{ $errors->first('rvtime') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.rvtime_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location_id">{{ trans('cruds.prev.fields.location') }}</label>
                <select class="form-control select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location_id" id="location_id">
                    @foreach($locations as $id => $entry)
                        <option value="{{ $id }}" {{ old('location_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="created_by_id">{{ trans('cruds.prev.fields.created_by') }}</label>
                <select class="form-control select2 {{ $errors->has('created_by') ? 'is-invalid' : '' }}" name="created_by_id" id="created_by_id" required>
                    @foreach($created_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('created_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('created_by'))
                    <span class="text-danger">{{ $errors->first('created_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.created_by_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('papyrus') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="papyrus" value="0">
                    <input class="form-check-input" type="checkbox" name="papyrus" id="papyrus" value="1" {{ old('papyrus', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="papyrus">{{ trans('cruds.prev.fields.papyrus') }}</label>
                </div>
                @if($errors->has('papyrus'))
                    <span class="text-danger">{{ $errors->first('papyrus') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.papyrus_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('prima') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="prima" value="0">
                    <input class="form-check-input" type="checkbox" name="prima" id="prima" value="1" {{ old('prima', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="prima">{{ trans('cruds.prev.fields.prima') }}</label>
                </div>
                @if($errors->has('prima'))
                    <span class="text-danger">{{ $errors->first('prima') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.prima_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prevresponsible_id">{{ trans('cruds.prev.fields.prevresponsible') }}</label>
                <select class="form-control select2 {{ $errors->has('prevresponsible') ? 'is-invalid' : '' }}" name="prevresponsible_id" id="prevresponsible_id">
                    @foreach($prevresponsibles as $id => $entry)
                        <option value="{{ $id }}" {{ old('prevresponsible_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('prevresponsible'))
                    <span class="text-danger">{{ $errors->first('prevresponsible') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.prevresponsible_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.prev.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01">
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cares">{{ trans('cruds.prev.fields.cares') }}</label>
                <input class="form-control {{ $errors->has('cares') ? 'is-invalid' : '' }}" type="number" name="cares" id="cares" value="{{ old('cares', '') }}" step="1">
                @if($errors->has('cares'))
                    <span class="text-danger">{{ $errors->first('cares') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.cares_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ambulancetransports">{{ trans('cruds.prev.fields.ambulancetransports') }}</label>
                <input class="form-control {{ $errors->has('ambulancetransports') ? 'is-invalid' : '' }}" type="number" name="ambulancetransports" id="ambulancetransports" value="{{ old('ambulancetransports', '') }}" step="1">
                @if($errors->has('ambulancetransports'))
                    <span class="text-danger">{{ $errors->first('ambulancetransports') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.ambulancetransports_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="report">{{ trans('cruds.prev.fields.report') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('report') ? 'is-invalid' : '' }}" name="report" id="report">{!! old('report') !!}</textarea>
                @if($errors->has('report'))
                    <span class="text-danger">{{ $errors->first('report') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.report_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.prev.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Prev::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prev.fields.status_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.prevs.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $prev->id ?? 0 }}');
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