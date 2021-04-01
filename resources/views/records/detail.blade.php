@extends('layouts.app')

@section('content')
    <section class="my-6">
        <div class="my-4">
            <a href="{{ url()->previous(route('home')) }}"
               class="text-primary hover:opacity-70 transition duration-300 ease-in-out">Back</a>
        </div>
        <div class="flex flex-col lg:flex-row">
            <div class="lg:w-6/12">
                <h1 class="font-semibold text-4xl">
                    {{ $record->title }}
                </h1>
                <h1 class="font-semibold text-2xl opacity-70">{{ $record->artist }}</h1>
                <img src="{{ asset('storage/records/' . $record->image) }}"
                     alt="album art for {{ $record->title }} by {{ $record->artist }}"
                     class="my-4"
                     width="500">
            </div>
            <div class="lg:w-6/12 flex flex-col justify-center items-center sm:text-2xl">
                <div class="flex flex-col justify-center items-center my-4">
                    <img src="{{ asset('/storage/avatar/' . $record->user->avatar) }}" alt="" width="100" class="rounded-full mr-4">
                    <h4 class="font-semibold pr-4">{{ $record->user->username }}</h4>
                </div>
                <div class="flex my-2">
                    <h4 class="font-semibold pr-4">Record Label:</h4>
                    <p class="font-light">{{ $record->label }}</p>
                </div>
                <div class="flex my-2">
                    <h4 class="font-semibold pr-4">Catalog #:</h4>
                    <p class="font-light">{{ $record->catalog_number }}</p>
                </div>
                <div class="flex my-2">
                    <h4 class="font-semibold pr-4">Year of Release:</h4>
                    <p class="font-light">{{ $record->year }}</p>
                </div>
                <div class="flex my-2">
                    <h4 class="font-semibold pr-4">Diameter:</h4>
                    <p class="font-light">{{ $record->diameter }}"</p>
                </div>
                <div class="flex my-2">
                    <h4 class="font-semibold pr-4">RPM:</h4>
                    <p class="font-light">{{ $record->rpm }}</p>
                </div>

                <div class="pt-2 text-sm flex text-gray-400 text-2xl my-8">
                    @auth
                        <form action="{{ $record->likes->contains(auth()->id()) ? route('unlike', $record->id) : route('like', $record->id) }}" method="post">
                            @csrf
                            <button type="submit">
                                <i class="far fa-heart mr-2 @if($record->likes->contains(auth()->id())) fas text-red-500 @endif"></i>
                            </button>
                        </form>
                    @endauth
                    <span class="font-medium">{{ $record->likes->count() }} {{ Str::plural('like', $record->likes->count()) }}</span>
                </div>
            </div>
        </div>

        <hr>
        <div class="flex flex-col my-4">
            <h2 class="font-semibold text-3xl">Comments</h2>

            <div class="flex flex-col my-4">
                <div class="border rounded-xl p-8">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('/storage/avatar/0kuetINANFXPLMRLochp3ApksEr9A7WbA6i45Kg7.jpg') }}" alt="" width="50" class="rounded-full mr-4">
                        <h4 class="font-semibold mr-4">folky_dokey</h4>
                        <h4 class="text-gray-400">1 day ago</h4>
                    </div>
                    <hr>
                    <div class="font-light mt-4">
                        Awesome dude!
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
