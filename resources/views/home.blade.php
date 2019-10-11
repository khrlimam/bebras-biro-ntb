@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container">
        @if($sd->count() > 0)
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('auth.grade.module.all', $sd[0]->grade->id) }}" class="card-link float-right">Lihat
                        semua
                        modul</a>
                    <h4>SD</h4>
                    <hr>
                </div>
                @foreach($sd as $module)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img data-src="{{ $module->media_path }}"
                                 class="center-cropped card-img-top lozad" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $module->title }}</h5>
                                <p class="card-text">{{ $module->description }}</p>
                                <span class="badge-{{ $module->jenis == 'ujian'? 'danger':'warning' }} badge">{{ $module->jenis }}</span>
                                <span class="badge-success badge">waktu: {{ $module->waktu }} menit</span>
                                <span class="badge-success badge">{{ $module->soals->count() }} soal</span>
                                <a href="{{ route('auth.module.show', $module->id) }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if($smp->count() > 0)
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('auth.grade.module.all', $smp[0]->grade->id) }}" class="card-link float-right">Lihat
                        semua
                        modul</a>
                    <h4>SMP</h4>
                    <hr>
                </div>
                @foreach($smp as $module)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img data-src="{{ $module->media_path }}"
                                 class="center-cropped card-img-top lozad" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $module->title }}</h5>
                                <p class="card-text">{{ $module->description }}</p>
                                <span class="badge-{{ $module->jenis == 'ujian'? 'danger':'warning' }} badge">{{ $module->jenis }}</span>
                                <span class="badge-success badge">waktu: {{ $module->waktu }} menit</span>
                                <span class="badge-success badge">{{ $module->soals->count() }} soal</span>
                                <a href="{{ route('auth.module.show', $module->id) }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if($sma->count() > 0)
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('auth.grade.module.all', $sma[0]->grade->id) }}" class="card-link float-right">Lihat
                        semua
                        modul</a>
                    <h4>SMA</h4>
                    <hr>
                </div>
                @foreach($sma as $module)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img data-src="{{ $module->media_path }}"
                                 class="center-cropped card-img-top lozad" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $module->title }}</h5>
                                <p class="card-text">{{ $module->description }}</p>
                                <span class="badge-{{ $module->jenis == 'ujian'? 'danger':'warning' }} badge">{{ $module->jenis }}</span>
                                <span class="badge-success badge">waktu: {{ $module->waktu }} menit</span>
                                <span class="badge-success badge">{{ $module->soals->count() }} soal</span>
                                <a href="{{ route('auth.module.show', $module->id) }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
