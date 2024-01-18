@extends('template')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Ask a Question!</h1>
            <p class="lead">
                Ask any question you want to know about Laravel, and we will get answers for you!
            </p>
            <hr class="my-4">
            <a href="{{ route('questions.create') }}" class="btn btn-primary btn-lg" role="button">Ask now!</a>
        </div>
        <br>

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

        {{ $questions->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
