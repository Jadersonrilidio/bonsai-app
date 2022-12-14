@extends('layouts.app')

@section('content')

@if (isset($message) and $message == "404 Not Found")
    <p align="center" style="font-size:1.4em; color:#a0aec0; margin: 60px auto; letter-spacing: 0.35em">
        404 | NOT FOUND
    </p>
@else
    <p align="center">
        <a href="http://bonsai-app.fly.dev/api/documentation" target="_blank">
            <img class="img-fluid" src="{{ asset('/images/bonsai-app-api-logo.png') }}">
        </a>
    </p>
@endif

<div class="pt-3">
    <nav class="navbar navbar-dark navbar-expand bg-secondary justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">Website</a></li>
            <li class="nav-item"><a class="nav-link" href="http://localhost:8000/api/documentation">API Documentation</a></li>
            <li class="nav-item"><a class="nav-link" href="https://github.com/Jadersonrilidio/bonsai_app_with_laravel_vuejs">GitHub Repository</a></li>
        </ul>
    </nav>
</div>

@endsection
