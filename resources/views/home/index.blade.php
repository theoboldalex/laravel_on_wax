@extends('layouts.app')

@section('content')
    @auth
        <h1 class="font-semibold text-3xl my-6">Hello {{ auth()->user()->username }}</h1>
        <hr>
    @endauth
    <h2 class="font-semibold text-2xl my-6">Latest uploads</h2>
    <div class="card-grid">
        @foreach ($records as $record)
            <div class="rounded overflow-hidden border w-full bg-white">
                <div class="w-full flex justify-between p-3">
                    <div class="flex">
                        <div class="rounded-full h-8 w-8 bg-gray-500 flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('storage/avatar/' . $record->user->avatar) }}" alt="profilepic">
                        </div>
                        <span class="pt-1 ml-2 font-bold text-sm"><a href="{{ route('profile', $record->user->username) }}">{{ $record->user->username }}</a></span>
                    </div>
                    <span class="px-2 hover:bg-gray-300 cursor-pointer rounded"><i class="fas fa-ellipsis-h pt-2 text-lg"></i></span>
                </div>
                <a href="{{ route('record_detail', $record->id) }}">
                    <img class="w-full bg-cover" src="{{ asset('storage/records/' . $record->image) }}" width="200">
                </a>
                <div class="px-3 pb-2">
                    <div class="pt-2">
                        <i class="far fa-heart cursor-pointer"></i>
                        <span class="text-sm text-gray-400 font-medium">12 likes</span>
                    </div>
                    <div class="pt-1">
                        <div class="mb-2 text-sm">
                            <p class="font-medium mr-2">{{ $record->artist }}</p>
                            <p class="">{{ $record->title }}</p>
                        </div>
                    </div>
                    <a href="{{ route('record_detail', $record->id) }}">
                        <div class="text-sm mb-2 text-gray-400 font-medium">View all 14 comments</div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
