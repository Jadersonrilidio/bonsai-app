@extends('layouts.app')

@section('content')
    
    <div class="container">
        User SETTINGS here!
        <br><hr><br>

        <div class="col md-8">
            <pre>
                {{ print_r(auth()->user()) }}
            </pre>
        </div>

    </div>

@endsection