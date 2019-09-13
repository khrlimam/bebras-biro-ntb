@extends('admin.layout.base')
@section('title', 'Tambah data sekolah')
@section('content')
    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('admin.school.index') }}"
                                   class="btn btn-outline-primary pull-right"><i class="fa fa-list"></i> List Sekolah</a>
                                <h3 class="card-title"><i class="fa fa-plus"></i> {{ __('Data Sekolah') }}</h3>
                                <hr>
                                <form method="POST" action="{{ route('admin.school.store') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="title"
                                               class="col-md-3 col-form-label">{{ __('Nama') }}</label>

                                        <div class="col-md-9">
                                            <input id="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   name="name"
                                                   value="{{ old('name') }}" required autofocus>

                                            @error('name')
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