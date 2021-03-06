@extends('admin.layout.base')
@section('title', 'Tambah data module')
@section('content')
    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('admin.module.index') }}"
                                   class="btn btn-outline-primary pull-right"><i class="fa fa-list"></i> List Modul</a>
                                <h3 class="card-title"><i class="fa fa-plus"></i> {{ __('Data Modul') }}</h3>
                                <hr>
                                <form method="POST" action="{{ route('admin.module.store') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="title"
                                               class="col-md-3 col-form-label">{{ __('Judul') }}</label>

                                        <div class="col-md-9">
                                            <input id="title" type="text"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   name="title"
                                                   value="{{ old('title') }}" required autofocus>

                                            @error('title')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description"
                                               class="col-md-3 col-form-label">{{ __('Deskripsi') }}</label>

                                        <div class="col-md-9">
                                            <textarea id="description" type="text" rows="10"
                                                      class="form-control @error('description') is-invalid @enderror"
                                                      name="description" value="{{ old('description') }}" required
                                                      autocomplete="description"></textarea>

                                            @error('description')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                                class="col-md-3 col-form-label">{{ __('Jenis modul') }}</label>

                                        <div class="col-md-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis"
                                                       id="latihan" value="latihan" checked>
                                                <label class="form-check-label" for="latihan">
                                                    Latihan
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis"
                                                       id="ujian" value="ujian">
                                                <label class="form-check-label" for="ujian">
                                                    Ujian
                                                </label>
                                            </div>

                                            @error('jenis')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="grade_id"
                                               class="col-md-3 col-form-label">{{ __('Modul untuk grade') }}</label>

                                        <div class="col-md-9">
                                            <select name="grade_id" id="grade_id" required
                                                    class="form-control @error('grade_id') is-invalid @enderror">
                                                <option>-- Pilih Grade --</option>
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}">{{ $grade->grade }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="waktu"
                                               class="col-md-3 col-form-label">{{ __('Lama waktu pengerjaan') }}</label>

                                        <div class="col-md-9">
                                            <input id="waktu" type="number"
                                                   class="form-control @error('waktu') is-invalid @enderror"
                                                   name="waktu"
                                                   placeholder="Masukkan angka dalam satuan menit. Contoh = 60"
                                                   value="{{ old('waktu') }}" required autofocus>

                                            @error('waktu')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-9 offset-md-3">
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