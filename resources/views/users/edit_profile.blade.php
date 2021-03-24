@extends('layouts.app')

@section('content')
    <h1>{{ auth()->user() }}</h1>
        <img src="{{ asset('storage/avatar/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->username }}'s avatar" width="200" class="rounded-full">
{{--    <form action="{{ route('edit_profile', auth()->user()->username) }}" method="POST" enctype="multipart/form-data">--}}
{{--    </form>--}}
@endsection
