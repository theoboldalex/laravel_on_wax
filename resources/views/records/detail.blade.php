@extends('layouts.app')

@section('content')
  <section class="my-8">
    <h1 class="font-semibold text-4xl">
      {{ $record->title }}
    </h1>
    <h1 class="font-semibold text-2xl opacity-70">{{ $record->artist }}</h1>
      <img src="{{ asset('storage/records/' . $record->image) }}" alt="album art for {{ $record->title }} by {{ $record->artsist }}" class="my-4">
  </section>
@endsection
