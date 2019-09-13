@extends('auth.layout')
@section('title', 'Profile')
@section('content1')
    <div class="card">
        <div class="card-header">
            Tantangan yang sudah diselesaikan
        </div>
        @if($attempts->count() > 0)
            <div class="list-group">
                @foreach($attempts as $attempt)
                    <a href="{{ route('auth.attempt.review', $attempt->id) }}"
                       class="list-group-item list-group-item-action">{{ $attempt->module->title }}</a>
                @endforeach
            </div>
        @else
            <div class="card-body">
                <div class="text-center">
                    <span class="text-muted fa fa-trash fa-3x"></span>
                    <h5 class="text-muted"> Belum ada tantangan yang kamu selesaikan.</h5>
                </div>
            </div>
        @endif
    </div>
@endsection
