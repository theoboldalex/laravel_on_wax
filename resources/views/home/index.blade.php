<style>
    #likeBtn:focus {
        outline: none;
    }
</style>

@extends('layouts.app')

@section('content')
    @auth
        <h1 class="font-semibold text-3xl my-6">Hello {{ auth()->user()->username }}</h1>
        <hr>
    @endauth
    <h2 class="font-semibold text-2xl my-6">Latest uploads</h2>
    <div class="card-grid">
        @foreach ($records as $record)
            <x-record-card :record="$record" />
        @endforeach
    </div>
    <hr class="my-8">
    @auth
        <section class="mb-8">
            <h2 class="font-semibold text-2xl my-6">Your Feed</h2>
            <div class="card-grid mb-8">
                @foreach($feed as $feedItem)
                    <x-record-card :record="$feedItem" />
                @endforeach
            </div>
            {{ $feed->links() }}
        </section>
    @endauth
@endsection
