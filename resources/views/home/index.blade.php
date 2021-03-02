@extends('layouts.app')

@section('content')
    @auth
        <h1 class="font-semibold text-3xl my-6">hello {{ auth()->user()->username }}</h1>
    @endauth
    <h2 class="font-semibold text-2xl my-6">Latest uploads</h2>
    <div class="card-grid">
        @foreach ($records as $record)
            <div class="border rounded-lg p-4 w-full">
                <h4 class="font-semibold text-xl">{{ $record->title }}</h4>
                <p>{{ $record->artist }}</p>
            </div>
        @endforeach
    </div>
@endsection