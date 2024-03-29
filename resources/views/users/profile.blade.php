@extends('layouts.app')
@livewireStyles

@section('content')
    <section>
        <div class="flex flex-col md:flex-row my-8">
            <div class="md:w-4/12 flex justify-center items-center">
                <img src="{{ Storage::disk('s3')->url('public/avatar/' . $user->avatar) }}" alt="profile image"
                     width="200" class="rounded-full">
            </div>
            <div class="md:w-8/12 flex flex-col items-center justify-center">
                <div class="flex flex-col md:flex-row justify-center items-center">
                    <h1 class="font-semibold text-xl mb-8 md:mb-0 md:text-3xl md:mr-8">{{ $user->username }}</h1>
                    <livewire:follow-button :isFollowing="$isFollowing" :user="$user">
                </div>
                <div class="flex flex-col md:flex-row">
                    <p class="mx-8 my-2 md:my-8">{{ $user->records->count() }} {{ Str::plural('Record', $user->records->count()) }}</p>
                    <a href="{{ route('following', $user->username) }}"
                       class="mx-8 my-2 md:my-8">{{ $user->following()->count() }} Following</a>
                    <a href="{{ route('followers', $user->username) }}"
                       class="mx-8 my-2 md:my-8">{{ $user->followers()->count() }} Followers</a>
                </div>
            </div>
        </div>
        <hr>
    </section>

    <section>
        <div class="card-grid my-8">
            @foreach ($user->records as $record)
                <x-record-card :record="$record"/>
            @endforeach
        </div>
    </section>
    @livewireScripts
@endsection
