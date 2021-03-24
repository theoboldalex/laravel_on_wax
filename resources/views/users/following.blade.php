@extends('layouts.app')

@section('content')
    <h1 class="font-semibold text-4xl my-8">Following</h1>
    <div class="card-grid">
        @foreach($user->following as $following)
            <div class="border rounded-lg p-4 flex flex-col justify-center items-center">
                <img src="{{ asset('storage/avatar/' . $following->avatar) }}" alt="{{ $following->username }}'s avatar" width="100" class="rounded-full my-4">
                <a href="{{ route('profile', $following->username) }}" class="font-semibold text-xl">{{ $following->username }}</a>
{{--                <form action="{{ $isFollowing ? route('unfollow', $user->username) : route('follow', $user->username) }}" method="post">--}}
{{--                    @csrf--}}
{{--                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:opacity-70 transition duration-300 ease">{{ $isFollowing ? 'Unfollow' : 'Follow' }}</button>--}}
{{--                </form>--}}
            </div>
        @endforeach
    </div>
@endsection
