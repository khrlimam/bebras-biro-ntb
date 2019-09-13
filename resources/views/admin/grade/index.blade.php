@extends('admin.layout.base')
@section('title', 'Grade')
@section('content')

    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('admin.grade.create') }}" class="pull-right btn btn-outline-primary">
                                    <i class="fa fa-plus"></i> Data Grade</a>
                                <h3 class="card-title">Grade</h3>
                            </div>
                            <table class="table-striped table">
                                <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Grade</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($grades as $grade)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $grade->grade }}</td>
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