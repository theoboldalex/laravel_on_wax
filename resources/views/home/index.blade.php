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
                        <span class="pt-1 ml-2 font-bold text-sm"><a
                                href="{{ route('profile', $record->user->username) }}">{{ $record->user->username }}</a></span>
                    </div>
                </div>
                <a href="{{ route('record_detail', $record->id) }}">
                    <img class="w-full bg-cover" src="{{ asset('storage/records/' . $record->image) }}" width="200">
                </a>
                <div class="px-3 pb-2">
                    <div class="pt-2 text-sm flex text-gray-400">
                        @auth
                            <form action="{{ route('like', $record->id) }}" method="post">
                                @csrf
                                <button type="submit">
                                    <i class="far fa-heart cursor-pointer mr-2"></i>
                                </button>
                            </form>
                        @endauth
                        <span class="font-medium">12 likes</span>
                    </div>
                    <div class="pt-1">
                        <div class="mb-2 text-sm">
                            <p class="font-medium mr-2">{{ $record->artist }}</p>
                            <p class="">{{ $record->title }}</p>
                        </div>
                    </div>
                    <a href="{{ route('record_detail', $record->id) }}">
                        <div
                            class="text-sm mb-2 text-gray-400 font-medium">{{ $record->created_at->diffForHumans() }}</div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <hr class="my-8">
    @auth
        <section class="mb-8">
            <h2 class="font-semibold text-2xl my-6">Your Feed</h2>
            <div class="card-grid mb-8">
                @foreach($feed as $feedItem)
                    <div class="rounded overflow-hidden border w-full bg-white">
                        <div class="w-full flex justify-between p-3">
                            <div class="flex">
                                <div
                                    class="rounded-full h-8 w-8 bg-gray-500 flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset('storage/avatar/' . $feedItem->user->avatar) }}"
                                         alt="profilepic">
                                </div>
                                <span class="pt-1 ml-2 font-bold text-sm"><a
                                        href="{{ route('profile', $feedItem->user->username) }}">{{ $feedItem->user->username }}</a></span>
                            </div>
                        </div>
                        <a href="{{ route('record_detail', $feedItem->id) }}">
                            <img class="w-full bg-cover" src="{{ asset('storage/records/' . $feedItem->image) }}"
                                 width="200">
                        </a>
                        <div class="px-3 pb-2">
                            <div class="pt-2 text-sm flex text-gray-400">
                                @auth
                                    <form action="{{ route('like', $record->id) }}" method="post">
                                        @csrf
                                        <button type="submit">
                                            <i class="far fa-heart cursor-pointer mr-2"></i>
                                        </button>
                                    </form>
                                @endauth
                                <span class="font-medium">12 likes</span>
                            </div>
                            <div class="pt-1">
                                <div class="mb-2 text-sm">
                                    <p class="font-medium mr-2">{{ $feedItem->artist }}</p>
                                    <p class="">{{ $feedItem->title }}</p>
                                </div>
                            </div>
                            <a href="{{ route('record_detail', $record->id) }}">
                                <div
                                    class="text-sm mb-2 text-gray-400 font-medium">{{ $feedItem->created_at->diffForHumans() }}</div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $feed->links() }}
        </section>
    @endauth
@endsection
