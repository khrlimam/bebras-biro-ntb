@extends('auth.layout')
@section('title', 'Edit Profile')
@section('content1')
    <div class="card">
        <div class="card-header">{{ __('Edit profile') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('auth.profile.update', '_') }}">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">{{ __('Nama') }}</label>

                    <div class="col-md-10">
                        <input id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror" name="name"
                               value="{{ old('name')?:$user->profile->name }}" autocomplete="off" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="no_induk" class="col-md-2 col-form-label">{{ __('No. Induk') }}</label>

                    <div class="col-md-10">
                        <input id="name" type="text"
                               class="form-control @error('no_induk') is-invalid @enderror" name="no_induk"
                               value="{{ old('no_induk')?:$user->profile->no_induk }}" autocomplete="off" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kelas"
                           class="col-md-2 col-form-label">{{ __('Kelas') }}</label>

                    <div class="col-md-10">
                        <input id="kelas" type="number" min="1" max="6"
                               class="form-control @error('kelas') is-invalid @enderror" name="kelas"
                               value="{{ old('kelas')?:$user->profile->kelas }}"
                               autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="grade"
                           class="col-md-2 col-form-label">{{ __('Grade') }}</label>
                    <div class="col-md-10">
                        <select id="grade" name="grade_id" class="form-control">
                            <option value="">-- Pilih Grade --</option>
                            @foreach(\App\Grade::all() as $grade)
                                <option {{ $user->profile->grade_id == $grade->id? 'selected':'' }} value="{{ $grade->id }}">{{ $grade->grade }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="school_id"
                           class="col-md-2 col-form-label">{{ __('Sekolah') }}</label>
                    <div class="col-md-10">
                        <select name="school_id" class="form-control">
                            <option value="">-- Pilih Sekolah --</option>
                            @foreach(\App\School::all() as $item)
                                <option {{ $user->profile->school_id == $item->id? 'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Simpan perubahan') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
