@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('auth.profile.edit', '_') }}" class="btn btn-primary float-right btn-sm"><span
                                    class="fa fa-pencil-alt"></span></a>
                        Profile
                    </div>
                    <table class="table">
                        <tr>
                            <th>Sekolah</th>
                            <td>{{ Auth::user()->profile->school? Auth::user()->profile->school->name:'-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ Auth::user()->profile->name }}</td>
                        </tr>
                        <tr>
                            <th>No. Induk</th>
                            <td>{{ Auth::user()->profile->no_induk?:'-' }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ Auth::user()->profile->kelas?:'-' }} {{ Auth::user()->profile->grade? Auth::user()->profile->grade->grade:'' }}</td>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="col-md-9">
                @yield('content1')
            </div>
        </div>
    </div>
@endsection