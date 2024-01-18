@extends('template')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">
                <h1>Enter an Address to get Weather</h1>
                <hr />

                <form action="{{ route('weather') }}" method="post">
                    {{ csrf_field() }}

                    <input type="text" name="location" class="form-control" style="margin:20px 0;" placeholder="Enter a zipcode or Address"> <br>
                    <input type="submit" class="btn btn-primary" style="width: 100%;" value="Get Weather">
                </form>
            </div>

        </div>
    </div>
@endsection
