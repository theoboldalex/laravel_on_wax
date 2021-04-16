@extends('layouts.app')

@section('content')
    <div class="my-4">
        <a href="{{ url()->previous(route('profile', $user->username)) }}"
           class="text-primary hover:opacity-70 transition duration-300 ease-in-out">Back</a>
    </div>
    <h1 class="font-semibold text-4xl my-4">Followers</h1>
    <div class="card-grid">
        @foreach($user->followers as $followers)
            <div class="border rounded-lg p-4 flex flex-col justify-center items-center">
                <img src="{{ Sotarge::disk('s3')->url('public/avatar/' . $followers->avatar) }}" alt="{{ $followers->username }}'s avatar" width="100" class="rounded-full my-4">
                <a href="{{ route('profile', $followers->username) }}" class="font-semibold text-xl">{{ $followers->username }}</a>
                {{--                <form action="{{ $isFollowing ? route('unfollow', $user->username) : route('follow', $user->username) }}" method="post">--}}
                {{--                    @csrf--}}
                {{--                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:opacity-70 transition duration-300 ease">{{ $isFollowing ? 'Unfollow' : 'Follow' }}</button>--}}
                {{--                </form>--}}
            </div>
        @endforeach
    </div>
@endsection

