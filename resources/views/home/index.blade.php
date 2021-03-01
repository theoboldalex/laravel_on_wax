@extends('layouts.app')

@section('content')
    @auth
        <h1>hello {{ auth()->user()->username }}</h1>
    @endauth
    <h1>Home</h1>
@endsection