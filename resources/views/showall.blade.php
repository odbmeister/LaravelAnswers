@extends('template')

@section('content')
    <div class="container">
        <h1 class="mb-4">Recent Questions:</h1>

        @foreach($questions as $question)
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">
                        {{ $question->title }}
                    </h3>
                    <p class="card-text">
                        {{ $question->description }}
                    </p>
                    <a href="{{ route('questions.show', $question->id) }}" class="btn btn-primary btn-sm">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
