@extends('admin.layout.base')
@section('title', 'Module')
@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Daftar hasil jawaban peserta pada module {{ $module->title }}</h3>
                            <table class="table table-hover" id="dataTable">
                                <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Score</th>
                                    <th>Jumlah detik</th>
                                    <th>Deskripsi waktu</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->score }}</td>
                                        <td>{{ $item->done_time }}</td>
                                        <td>{{ $item->human_time }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection