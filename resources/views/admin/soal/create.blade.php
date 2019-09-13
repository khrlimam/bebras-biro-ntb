@extends('admin.layout.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('summernote/summernote-lite.css') }}">
@endsection
@section('title', 'Tambah data module')
@section('content')

    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('admin.module.soal.show', Request::route('moduleid')) }}"
                                   class="btn btn-outline-primary pull-right"><i class="fa fa-list"></i> Lihat daftar
                                    soal untuk modul ini</a>
                                <h3 class="card-title"><i class="fa fa-plus"></i> {{ __('Data Soal') }}</h3>
                                <p class="card-subtitle text-muted">Tambah data soal untuk
                                    modul: <strong>{{ $module->title }}</strong></p>
                                <hr>
                                <form method="POST" action="{{ route('admin.soal.store') }}">
                                    @csrf
                                    <input type="hidden" name="module_id" value="{{ Request::route('moduleid') }}">
                                    <div class="form-group row">
                                        <label for="tinymce"
                                               class="col-md-2 col-form-label">{{ __('Soal') }}</label>

                                        <div class="col-md-10">
                                            <textarea id="tinymce" type="text"
                                                      class="form-control @error('soal') is-invalid @enderror"
                                                      name="soal">{{ old('soal') }}</textarea>

                                            @error('soal')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                                class="col-md-2 col-form-label">{{ __('Jenis jawaban') }}</label>

                                        <div class="col-md-10">
                                            <div class="form-check">
                                                <input class="form-check-input" onclick="togglePilihans(false)"
                                                       type="radio" name="jenis_jawaban"
                                                       id="pilihan"
                                                       value="pilihan" {{ old('jenis_jawaban') == 'pilihan'? 'checked':'' }}>
                                                <label class="form-check-label" for="pilihan">
                                                    Pilihan
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" onclick="togglePilihans(true)"
                                                       type="radio" name="jenis_jawaban"
                                                       id="isian"
                                                       value="isian" {{ old('jenis_jawaban') == 'isian'? 'checked':'' }}>
                                                <label class="form-check-label" for="isian">
                                                    Isian
                                                </label>
                                            </div>

                                            @error('jenis')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row" id="pilihans">
                                        <label class="col-md-2 col-form-label">{{ __('Masukkan pilihan') }}</label>

                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control @error('pilihans.0') is-invalid @enderror"
                                                       name="pilihans[]"
                                                       placeholder="Masukkan pilihan"
                                                       value="{{ old('pilihans.0') }}" autofocus>

                                                @error('pilihans.0')
                                                <span class="invalid-feedback"
                                                      role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control @error('pilihans.1') is-invalid @enderror"
                                                       name="pilihans[]"
                                                       placeholder="Masukkan pilihan"
                                                       value="{{ old('pilihans.1') }}" autofocus>

                                                @error('pilihans.1')
                                                <span class="invalid-feedback"
                                                      role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control @error('pilihans.2') is-invalid @enderror"
                                                       name="pilihans[]"
                                                       placeholder="Masukkan pilihan"
                                                       value="{{ old('pilihans.2') }}" autofocus>
                                                @error('pilihans.2')
                                                <span class="invalid-feedback"
                                                      role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control @error('pilihans.3') is-invalid @enderror"
                                                       name="pilihans[]"
                                                       placeholder="Masukkan pilihan"
                                                       value="{{ old('pilihans.3') }}" autofocus>

                                                @error('pilihans.3')
                                                <span class="invalid-feedback"
                                                      role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="jawaban"
                                               class="col-md-2 col-form-label">{{ __('Jawaban') }}</label>

                                        <div class="col-md-10">
                                            <input id="jawaban" type="text"
                                                   class="form-control @error('jawaban') is-invalid @enderror"
                                                   name="jawaban"
                                                   placeholder="Masukkan kunci jawaban"
                                                   value="{{ old('jawaban') }}" required autofocus>

                                            @error('jawaban')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> {{ __('Simpan') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script>
        let pilihans = document.getElementById("pilihans")

        function togglePilihans(hidden) {
            pilihans.hidden = hidden
        }

        @if(old('jenis_jawaban') == 'isian')
        togglePilihans(true)
        @elseif(old('jenis_jawaban') == 'pilihan')
        togglePilihans(false)
        @else
        togglePilihans(true)
        @endif

    </script>
@endsection