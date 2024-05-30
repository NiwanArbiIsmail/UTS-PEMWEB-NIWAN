@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.beasiswa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.beasiswas.update", [$beasiswa->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.beasiswa.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $beasiswa->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nim">{{ trans('cruds.beasiswa.fields.nim') }}</label>
                <input class="form-control {{ $errors->has('nim') ? 'is-invalid' : '' }}" type="text" name="nim" id="nim" value="{{ old('nim', $beasiswa->nim) }}">
                @if($errors->has('nim'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nim') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.nim_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jurusan">{{ trans('cruds.beasiswa.fields.jurusan') }}</label>
                <input class="form-control {{ $errors->has('jurusan') ? 'is-invalid' : '' }}" type="text" name="jurusan" id="jurusan" value="{{ old('jurusan', $beasiswa->jurusan) }}" step="0.01">
                @if($errors->has('jurusan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jurusan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.jurusan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fakultas">{{ trans('cruds.beasiswa.fields.fakultas') }}</label>
                <input class="form-control {{ $errors->has('fakultas') ? 'is-invalid' : '' }}" type="text" name="fakultas" id="fakultas" value="{{ old('fakultas', $beasiswa->fakultas) }}" step="1">
                @if($errors->has('fakultas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fakultas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.fakultas_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="indeks">{{ trans('cruds.beasiswa.fields.indeks') }}</label>
                <input class="form-control {{ $errors->has('indeks') ? 'is-invalid' : '' }}" type="text" name="indeks" id="indeks" value="{{ old('indeks', $beasiswa->indeks) }}" step="1">
                @if($errors->has('indeks'))
                    <div class="invalid-feedback">
                        {{ $errors->first('indeks') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.indeks_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="beasiswa">{{ trans('cruds.beasiswa.fields.beasiswa') }}</label>
                <input class="form-control {{ $errors->has('beasiswa') ? 'is-invalid' : '' }}" type="text" name="beasiswa" id="beasiswa" value="{{ old('beasiswa', $beasiswa->beasiswa) }}" step="1">
                @if($errors->has('beasiswa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('beasiswa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.beasiswa_helper') }}</span>
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
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.beasiswas.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($beasiswa) && $beasiswa->image)
      var file = {!! json_encode($beasiswa->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection
