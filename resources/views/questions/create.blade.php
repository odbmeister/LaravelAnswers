@extends('template')

@section('content')
    <div class="container">
        <h1>Ask a Question!</h1>
        <hr/>
        <form action="{{ route('questions.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Question:</label>
                <input type="text" name="title" id="title" class="form-control" />
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">More Information:</label>
                <textarea class="form-control" name="description" id="description" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Question</button>
        </form>
    </div>
@endsection
