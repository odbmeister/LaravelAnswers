@extends('template')

@section('content')
    <div class="container">
        <h1>Edit Answer</h1>
        <hr/>

        <form action="{{ route('answers.update', $answer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="content" class="form-label">Answer:</label>
                <textarea class="form-control" name="content" id="content" rows="4">{{ $answer->content }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Answer</button>
        </form>
    </div>
@endsection
