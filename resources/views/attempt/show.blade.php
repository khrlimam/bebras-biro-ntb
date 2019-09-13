@extends('layouts.app')
@section('title', 'Tantangan modul '.$attempt->module->title)
@section('content')
    <div class="container">
        <a href="{{ route('auth.attempt.review', $attempt->id) }}" class="btn btn-primary float-right">Selesai
            dan Review 😊</a>
        <h3>Jawab soal {{ $attempt->module->title }}</h3>
        <p>Jangan lupa berdoa sebelum mengerjakan, semangat!</p>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="progress h-100 hand">
                        @foreach($attempt->module->soals as $_)
                            <div class="progress-bar @if(isset($userAnswers[$_->id])) {{ $userAnswers[$_->id]->first()['correct']? 'bg-success':'bg-danger' }} @endif"
                                 role="progressbar"
                                 onclick="getQuestionAt('{{ route('auth.attempt.question_at', ['id' => $attempt->id,'position' => $loop->index]) }}')"
                                 style="width: {{ $width }}%;"
                                 aria-valuenow="{{ $width }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100"
                                 data-toggle="tooltip"
                                 progress-id="{{ $_->id }}"
                                 data-placement="bottom"
                                 title="Klik untuk melihat soal {{ $loop->iteration }}">
                                Soal {{ $loop->iteration }}
                            </div>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('auth.answer.store') }}"
                              onsubmit="event.preventDefault(); sendAnswer(this)">
                            @csrf
                            <input type="hidden" name="soal_id" value="{{ $soal->id }}">
                            <input type="hidden" name="attempt_id" value="{{ $attempt->id }}">
                            <div id="soal">{!! $soal->soal !!}</div>
                            <br>
                            <div id="jawaban">
                                @if($soal->jenis_jawaban == 'pilihan')
                                    @foreach($soal->pilihans as $pilihan)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jawaban"
                                                   id="{{ $pilihan->id }}" value="{{ $pilihan->pilihan }}">
                                            <label class="form-check-label" for="{{ $pilihan->id }}">
                                                {{ $pilihan->pilihan }}
                                            </label>
                                        </div>
                                    @endforeach
                                    @error('pilihan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                @else
                                    <input type="text" name="jawaban" class="form-control" autocomplete="off"
                                           placeholder="Tulis jawaban disini">
                                @endif
                            </div>
                            <hr>
                            <button class="btn btn-primary btn-block" type="submit">Jawab</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>

        let cache = {};

        function nextQuestion() {
            fetch('{{ route('auth.attempt.nextquestion', $attempt->id) }}', {
                method: 'GET',
            }).then((r) => r.json().then((data) => {
                if (data.all) {
                    Swal.fire({
                        type: 'info',
                        title: 'Semua soal sudah kamu jawab 😊',
                        confirmButtonText: 'Selesai dan review',
                    }).then((result) => {
                        if (result.value) {
                            document.location = "{{ route('auth.attempt.review', $attempt->id) }}"
                        }
                    })
                }
                populateNewSoalData(data)
            }));
        }

        function getQuestionAt(nextQuestionUrl) {
            try {
                populateNewSoalData(cache[nextQuestionUrl]);
            } catch (e) {
                fetch(nextQuestionUrl, {
                    method: 'GET',
                }).then((r) => r.json().then((data) => {
                    cache[nextQuestionUrl] = data;
                    populateNewSoalData(data)
                }));
            }
        }

        let soal_;

        let populateNewSoalData = (soalData) => {
            soal.innerHTML = soalData.soal;
            setSoalId(soalData.id);
            jawaban.innerHTML = renderJawaban(soalData)
        };

        function renderJawaban(soal) {
            let type = soal.jenis_jawaban;
            let render = `<input type="text" name="jawaban" class="form-control" autocomplete="off" placeholder="Tulis jawaban disini">`;
            if (type === 'pilihan') {
                let pilihans = soal.pilihans;
                render = pilihans.map((item) => {
                    return `<div class="form-check"><input class="form-check-input" type="radio" name="jawaban" id="${item.id}" value="${item.pilihan}"><label class="form-check-label" for="${item.id}">${item.pilihan}</label></div>`
                }).join('');
            }
            return render
        }

        let setSoalId = (id) => {
            $("input[name='soal_id']").val(id)
        };

        function sendAnswer(form) {
            let data = new FormData(form);
            console.log(data.get('jawaban'))
            if (data.get("jawaban") !== null) {
                fetch(form.action, {
                    method: form.method,
                    body: data
                }).then((r) => {
                    if (r.status === 201) {
                        console.log("resource created succesfully")
                        r.json().then((data) => {
                            console.log(data);
                            alertAndNext(data);
                        });
                    } else if (r.status === 302) {
                        Swal.fire({
                            type: 'info',
                            title: 'Soal ini telah kamu jawab 😋',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                })
            } else console.log("jawaban kosong, not doing anything!")
        }

        function alertAndNext(data) {
            if (data.correct) {
                document.querySelector(`div[progress-id='${data.soal_id}']`).classList.add('bg-success');
                type = 'success';
                subtitle = 'Selamat, jawabanmu benar!';
                title = happies[(Math.random() * happies.length) | 0]
            } else {
                document.querySelector(`div[progress-id='${data.soal_id}']`).classList.add('bg-danger');
                type = 'error';
                subtitle = `Yaaahhh.. jawabanmu salah..<br>Jawaban yang benar adalah:<br><strong>${data.jawaban_benar}</strong>`;
                title = sads[(Math.random() * sads.length) | 0]
            }
            Swal.fire({
                title: `<span class="display-4">${title}<span>`,
                html: subtitle,
                type: type,
                confirmButtonText: 'Soal berikutnya'
            }).then(() => {
                nextQuestion()
            })
        }

    </script>
@endsection