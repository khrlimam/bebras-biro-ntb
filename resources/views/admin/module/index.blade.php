@extends('admin.layout.base')
@section('title', 'Module')
@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin.module.create') }}" class="pull-right btn btn-outline-primary"> <i
                                        class="fa fa-plus"></i> Data Modul</a>
                            <h3 class="card-title">Daftar Modul</h3>
                            <p class="card-subtitle text-muted">Terdapat modul sebanyak {{ $modules->count() }}</p>
                        </div>
                        <table class="table table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th>Modul</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($modules as $module)
                                <tr>
                                    <td>
                                        <h4>{{ $module->title }}</h4>
                                        {{ $module->description }}<br>
                                        <span class="badge-success badge">jumlah soal: {{ $module->soalCount() }}</span>
                                        <span class="badge badge-info">grade: {{ $module->grade->grade }}</span>
                                        <span class="badge badge-primary">jenis: {{ $module->jenis }}</span>
                                        <span class="badge badge-primary">waktu: {{ $module->waktu }} menit</span>
                                    </td>
                                    <td>
                                        <form method="POST"
                                              action="{{ route('admin.module.destroy', $module->id) }}"
                                              onsubmit="event.preventDefault(); confirmDeleteForm(this)"
                                              class="btn btn-group btn-group-sm">
                                            <a href="{{ route('admin.module.attempts', $module->id) }}"
                                               class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom"
                                               title="Lihat score peserta pada modul ini">Score
                                            </a>
                                            <a href="{{ route('admin.module.soal.show', $module->id) }}"
                                               class="btn btn-success" data-toggle="tooltip" data-placement="bottom"
                                               title="Lihat daftar soal"><i class="fa fa-list"></i>
                                            </a>
                                            <a href="{{ route('admin.soal.create', $module->id) }}"
                                               class="btn-primary btn" data-toggle="tooltip" data-placement="bottom"
                                               title="Tambah soal"><i class="fa fa-plus"></i></a>
                                            <a href="{{ route('admin.module.edit', $module->id) }}"
                                               class="btn btn-warning" data-toggle="tooltip" data-placement="bottom"
                                               title="Edit modul"><i class="fa fa-pencil-alt"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                                                    data-placement="bottom" title="Hapus modul"><i
                                                        class="fa fa-trash"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection