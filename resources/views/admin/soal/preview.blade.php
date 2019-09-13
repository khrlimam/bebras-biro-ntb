@extends('admin.layout.base')
@section('title', 'Preview soal')
@section('content')
    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="btn-group pull-right">
                                    <a href="{{ route('admin.module.soal.show', $soal->modules->id) }}"
                                       class="btn btn-outline-primary pull-right" data-toggle="tooltip"
                                       data-placement="bottom" title="Lihat daftar soal modul ini"><i
                                                class="fa fa-list"></i></a>
                                    <a href="{{ route('admin.soal.create', $soal->modules->id) }}"
                                       class="btn-outline-primary btn pull-right" data-toggle="tooltip"
                                       data-placement="bottom" title="Tambah soal baru modul ini"><i
                                                class="fa fa-plus"></i></a>
                                    <a href="{{ route('admin.soal.edit', $soal->id) }}" class="btn btn-outline-dark"
                                       data-toggle="tooltip" data-placement="bottom" title="Edit soal ini"><i
                                                class="fa fa-pencil-alt"></i></a>
                                </div>
                                <h4 class="card-title">Modul: {{ $soal->modules->title }}</h4>
                                <p class="card-subtitle text-muted">
                                    Grade: {{ $soal->modules->grade->grade }}
                                </p>
                                <hr>
                                <h4 class="card-title">Soal</h4>
                                {!! $soal->soal !!}
                                <br>
                                @if($soal->jenis_jawaban == 'pilihan')
                                    <div class="col-md-9">
                                        @foreach($soal->pilihans as $pilihan)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pilihan"
                                                       id="{{ $pilihan->pilihan }}" value="{{ $pilihan->pilihan }}">
                                                <label class="form-check-label" for="{{ $pilihan->pilihan }}">
                                                    {{ $pilihan->pilihan }}
                                                </label>
                                            </div>
                                        @endforeach
                                        @error('pilihan')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                @endif
                                <br>
                                <h4 class="card-title">Jawaban</h4>
                                {{ $soal->jawaban }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection