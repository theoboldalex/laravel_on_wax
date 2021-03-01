@extends('layouts.app')

@section('content')
    <section>
        <div class="flex my-8">
            <div class="md:w-4/12 flex justify-center items-center">
                <img src="{{ asset('img/profile.jpg') }}" alt="profile image" width="200" class="rounded-full">
            </div>
            <div class="md:w-8/12 flex flex-col items-center justify-center">
                <div class="flex justify-center items-center">
                    <h1 class="font-semibold text-3xl mr-8">{{ auth()->user()->username }}</h1>
                    <form action="" method="post">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:opacity-70 transition duration-300 ease">Follow</button>
                    </form>
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