@extends('template')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">
                <h1>Upload a Profile Picture</h1>
                <hr />

                <form action="{{ route('upload.post') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <input type="file" name="picture" style="margin:20px 0;"> <br>
                    <input type="submit" class="btn btn-primary" value="Upload">
                </form>
            </div>

        </div>
    </div>
@endsection
