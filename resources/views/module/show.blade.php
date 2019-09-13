@extends('layouts.app')
@section('title', 'Module '.$module->title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-4">{{ $module->title }}</h1>
                    <p class="lead">{{ $module->description }}</p>
                    <p class="text-info">Grade: {{ $module->grade->grade }}, jumlah soal: {{ $module->soals->count() }},
                        waktu pengerjaan: {{ $module->waktu }} menit.</p>
                    <hr class="my-4">
                    <form action="{{ route('auth.attempt.store') }}" method="POST"
                          onsubmit="event.preventDefault(); warnBeforeAttempt(this)">
                        @csrf
                        <input type="hidden" name="title" value="{{ $module->title }}">
                        <input type="hidden" name="waktu" value="{{ $module->waktu }}">
                        <input type="hidden" value="{{ $module->id }}" name="module_id">
                        <button type="submit" class="btn btn-primary btn-lg" role="button">Jawab tantangan sekarang!
                        </button>
                    </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function warnBeforeAttempt(form) {
            let title = $("input[name='title']").val()
            let waktu = $("input[name='waktu']").val()
            Swal.fire({
                title: `${title}`,
                text: `Tantangan ini membutuhkan waktu ${waktu} menit untuk diselesaikan. Ingin mulai sekarang? `,
                type: 'info',
                showCancelButton: true,
                cancelButtonText: 'Belum siap 😴',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, mulai sekarang 👊!'
            }).then((result) => {
                if (result.value) {
                    form.submit()
                }
            })
        }
    </script>
@endsection