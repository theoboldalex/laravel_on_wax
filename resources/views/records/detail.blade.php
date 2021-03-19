@extends('layouts.app')

@section('content')
    <section class="my-6">
        <div class="my-4">
            <a href="{{ url()->previous(route('home')) }}"
               class="text-primary hover:opacity-70 transition duration-300 ease-in-out">Back</a>
        </div>
        <h1 class="font-semibold text-4xl">
            {{ $record->title }}
        </h1>
        <h1 class="font-semibold text-2xl opacity-70">{{ $record->artist }}</h1>
        <img src="{{ asset('storage/records/' . $record->image) }}"
             alt="album art for {{ $record->title }} by {{ $record->artist }}"
             class="my-4"
             width="500">
    </section>
@endsection
