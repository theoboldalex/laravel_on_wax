@extends('layouts.app')

@section('content')
    <h1>{{ auth()->user() }}</h1>
        <img src="{{ asset('storage/avatar/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->username }}'s avatar" width="200" class="rounded-full">
    <form action="{{ route('edit_profile', auth()->user()->username) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col my-2">
            <label for="avatar">Edit Avatar</label>
            <input type="file" name="avatar">
            @error('avatar')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="w-full bg-primary rounded-lg py-2 my-6 text-white font-light hover:opacity-70 transition duration-300 ease">Save</button>
    </form>
@endsection
