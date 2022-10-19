@extends('layouts.app')

@section('content')

    <home-component user="{{ auth()->user() }}"></home-component>

@endsection
