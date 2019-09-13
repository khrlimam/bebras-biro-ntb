@extends('admin.layout.base')
@section('title', 'Daftar soal modul '.$module->title)
@section('content')
    <div class="section__content section__content--p30">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('admin.soal.create', $module->id) }}"
                   class="btn-outline-primary btn pull-right"><i class="fa fa-plus"></i> Tambah soal untuk modul ini</a>
                <h2 class="display-4">{{ $module->title }}</h2>
                <h4>grade: {{ $module->grade->grade }}, waktu: {{ $module->waktu }} menit,
                    jumlah soal: {{ $module->soals->count() }}</h4>
                <hr>
                @foreach($module->soals as $soal)
                    <div class="card">
                        <div class="card-body">
                            {!! $soal->soal !!}
                            <hr>
                            <div class="text-right">
                                <form class="btn-group btn-group-sm"
                                      action="{{ route('admin.soal.destroy', $soal->id) }}" method="POST"
                                      onsubmit="event.preventDefault(); confirmDeleteForm(this)">
                                    <a href="{{ route('admin.soal.show', $soal->id) }}" class="btn btn-success"><i
                                                class="fa fa-eye"></i> Preview soal</a>
                                    <a href="{{ route('admin.soal.edit', $soal->id) }}" class="btn btn-warning"><i
                                                class="fa fa-pencil-alt"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection