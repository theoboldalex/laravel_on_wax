@extends('layouts.app')

@section('content')
    <section>
        <div class="flex my-8">
            <div class="md:w-4/12 flex justify-center items-center">
                <img src="{{ asset('storage/avatar/' . $user->avatar) }}" alt="profile image" width="200" class="rounded-full">
            </div>
            <div class="md:w-8/12 flex flex-col items-center justify-center">
                <div class="flex justify-center items-center">
                    <h1 class="font-semibold text-3xl mr-8">{{ $user->username }}</h1>
                    @auth
                        @if(auth()->user()->username != Str::after(url()->full(), env('APP_URL') . '/users/'))
                            <form action="{{ $isFollowing ? route('unfollow', $user->username) : route('follow', $user->username) }}" method="post">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:opacity-70 transition duration-300 ease">{{ $isFollowing ? 'Unfollow' : 'Follow' }}</button>
                            </form>
                        @else
                            <form action="" method="post">
                                @csrf
                                <a href="{{ route('edit_profile', auth()->user()->username) }}" class="px-4 py-3 bg-primary text-white rounded-lg hover:opacity-70 transition duration-300 ease">Edit Profile</a>
                            </form>
                        @endif
                    @endauth
                </div>
                <div class="flex">
                    <a href="" class="mx-8 my-8">{{ $user->records->count() }} {{ Str::plural('Record', $user->records->count()) }}</a>
                    <a href="" class="mx-8 my-8">Following</a>
                    <a href="" class="mx-8 my-8">Followers</a>
                </div>
            </div>
        </div>
        <hr>
    </section>

    <section>
        <div class="card-grid my-8">
            @foreach ($user->records as $record)
                <div class="rounded overflow-hidden border w-full bg-white">
                    <img class="w-full bg-cover" src="{{ asset('storage/records/' . $record->image) }}" width="200">
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
                            <div class="text-sm mb-2 text-gray-400 font-medium">{{ $record->created_at->diffForHumans() }}</div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
