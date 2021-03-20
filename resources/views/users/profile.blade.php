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
                            <form action="" method="post">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:opacity-70 transition duration-300 ease">Follow</button>
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
                    <a href="" class="mx-8 my-8">Records</a>
                    <a href="" class="mx-8 my-8">Following</a>
                    <a href="" class="mx-8 my-8">Followers</a>
                </div>
            </div>
        </div>
        <hr>
    </section>
@endsection
