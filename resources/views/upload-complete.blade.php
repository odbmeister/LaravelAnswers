@extends('template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1>File Uploaded</h1>
                <hr />

                <div class="text-center">
                    @if(session()->has('url'))
                        <img src="{{ session('url') }}" class="img-rounded" />
                    @else
                        <p>No image available</p>
                    @endif
                </div>

                <ul style="margin: 20px;">
                    @if(session()->has('filename'))
                        <li><strong>Filename: </strong>{{ session('filename')  }}</li>
                    @else
                        <li><strong>Filename not available</strong></li>
                    @endif

                    @if(session()->has('url'))
                        <li><strong>Storage Path: </strong>{{ session('url') }}</li>
                    @else
                        <li><strong>Storage Path not available</strong></li>
                    @endif
                </ul>

                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('index') }}" class="btn btn-default" style="width:100%;">Go Home</a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('upload') }}" class="btn btn-default" style="width:100%;">Upload Again</a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('profile', Auth::id()) }}" class="btn btn-default" style="width:100%;">View Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
