@extends('layouts.app')

@section('content')

    <home-component 
        userid="{{ auth()->user()->id }}"
        username="{{ auth()->user()->name }}"
    >
    </home-component>

@endsection
