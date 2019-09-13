@extends('layouts.app')
@section('title', 'Review jawaban '.$attempt->module->title)
@section('content')
    <div class="container">
        @if(!$attempt->done)
            <form action="{{ route('auth.attempt.done') }}" method="POST">
                @csrf
                <input type="hidden" name="attempt_id" value="{{ $attempt->id }}">
                <button class="btn btn-secondary float-right" type="submit">Selesai 🤓</button>
            </form>
        @else
            <div class="float-right">
                Nilai: {{ $score }}, waktu selesai: {{ $attempt->doneTimeHumanDescription() }}
            </div>
        @endif
        <h3 class="card-title">Review jawaban tantangan {{ $attempt->module->title }}</h3>
        @foreach($attempt->module->soals as $soalItem)
            <div class="card mb-5">
                <div class="card-body">
                    <h5 class="card-title">Soal {{ $loop->iteration }}</h5>
                    {!!  $soalItem->soal  !!}
                    @if($soalItem->jenis_jawaban == 'pilihan')
                        @foreach($soalItem->pilihans as $pilihan)
                            <div class="form-check">
                                @if(isset($attempt->answers[$soalItem->id]))
                                    @if($attempt->answers[$soalItem->id]->first()->jawaban == $pilihan->pilihan)
                                        <input disabled checked
                                               class="form-check-input {{ $attempt->answers[$soalItem->id]->first()->correct? 'is-valid':'is-invalid' }}"
                                               type="radio"
                                               value="{{ $pilihan->pilihan }}">
                                        <label class="form-check-label">{{ $pilihan->pilihan }}</label>
                                    @else
                                        <input disabled
                                               class="form-check-input"
                                               type="radio"
                                               value="{{ $pilihan->pilihan }}">
                                        <label class="form-check-label">{{ $pilihan->pilihan }}</label>
                                    @endif
                                @else
                                    <input disabled
                                           class="form-check-input"
                                           type="radio"
                                           value="{{ $pilihan->pilihan }}">
                                    <label class="form-check-label">{{ $pilihan->pilihan }}</label>
                                @endif
                                @if(isset($attempt->answers[$soalItem->id]))
                                    @if($attempt->answers[$soalItem->id]->first()->correct)
                                        <div class="valid-feedback" role="alert">
                                            <h6>Jawabanmu benar 🤗</h6>
                                        </div>
                                    @else
                                        <div class="invalid-feedback" role="alert">
                                            <h6>Jawabanmu salah 😌 <br> jawaban yang benar
                                                adalah {{ $soalItem->jawaban }}</h6>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    @else
                        <input disabled type="text"
                               value="{{ isset($attempt->answers[$soalItem->id])? $attempt->answers[$soalItem->id]->first()->jawaban:'' }}"
                               name="jawaban"
                               class="form-control {{ isset($attempt->answers[$soalItem->id])? $attempt->answers[$soalItem->id]->first()->correct? 'is-valid':'is-invalid':'' }}"
                               autocomplete="off"
                               placeholder="Tulis jawaban disini">
                        @if(isset($attempt->answers[$soalItem->id]))
                            @if($attempt->answers[$soalItem->id]->first()->correct)
                                <div class="valid-feedback" role="alert">
                                    <h6>Jawabanmu benar 🤗</h6>
                                </div>
                            @else
                                <div class="invalid-feedback" role="alert">
                                    <h6>Jawabanmu salah 😌 <br> jawaban yang benar adalah {{ $soalItem->jawaban }}</h6>
                                </div>
                            @endif
                        @endif
                    @endif

                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            @if($attempt->done)
            Swal.fire(
                {
                    type: 'info',
                    showConfirmButton: false,
                    text: 'Nilaimu untuk tantangan ini adalah {{ $score }}. Soal dikerjakan dalam waktu {{ $attempt->doneTimeHumanDescription() }}',
                    timer: 5000
                }
            )
            @endif
        })
    </script>
@endsection