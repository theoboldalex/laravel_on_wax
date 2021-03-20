@extends('layouts.app')

@section('content')
    <h1>{{ auth()->user() }}</h1>
        <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" alt="">
{{--    <form action="{{ route('edit_profile', auth()->user()->username) }}" method="POST" enctype="multipart/form-data">--}}
{{--    </form>--}}
@endsection
