@extends('admin.layout.base')
@section('title', 'Sekolah')
@section('content')

    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('admin.school.create') }}" class="pull-right btn btn-outline-primary">
                                    <i class="fa fa-plus"></i> Data Sekolah</a>
                                <h3 class="card-title">Sekolah</h3>
                            </div>
                            <table class="table-striped table">
                                <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Sekolah</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($schools as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <form class="btn-group" role="group" aria-label="Basic example"
                                                  action="{{ route('admin.school.destroy', $item->id) }}" method="POST"
                                                  onsubmit="event.preventDefault();confirmDeleteForm(this)">
                                                <a href="{{ route('admin.school.edit', $item->id) }}"
                                                   class="btn btn-warning"><span class="fa fa-pencil-alt"></span></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash"></i> Hapus
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
    </section>

@endsection