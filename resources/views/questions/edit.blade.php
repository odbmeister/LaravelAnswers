@extends('template')

@section('content')
    <div class="container">
        <h1>Edit Question</h1>
        <hr/>

        <form action="{{ route('questions.update', $question->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Question:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $question->title }}" />
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">More Information:</label>
                <textarea class="form-control" name="description" id="description" rows="4">{{ $question->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Question</button>
        </form>
    </div>
@endsection
