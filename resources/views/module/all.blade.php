@extends('layouts.app')
@section('title', 'Modul '.$modules[0]->grade->grade)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    {{ $modules->links() }}
                </div>
                <h4 class="text-capitalize">Semua modul {{ $modules[0]->grade->grade }}</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            @foreach($modules as $module)
                <div class="col-md-6 mb-3">
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
        <div class="row justify-content-center">
            {{ $modules->links() }}
        </div>
    </div>

@endsection