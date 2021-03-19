@extends('layouts.app')

@section('content')
    <section class="my-8">
        <h1 class="font-semibold text-3xl">Add to your collection</h1>
        <form action="{{ route('create', auth()->user()->username) }}" method="POST" class="font-light" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col my-2">
                <label for="title">Title:</label>
                <input type="text" name="title" class="border rounded-lg p-2">
            </div>
            <div class="flex flex-col my-2">
                <label for="artist">Artist:</label>
                <input type="text" name="artist" class="border rounded-lg p-2">
            </div>
            <div class="flex flex-col my-2">
                <label for="label">Label:</label>
                <input type="text" name="label" class="border rounded-lg p-2">
            </div>
            <div class="flex flex-col my-2">
                <label for="catalog_number">Catalog number:</label>
                <input type="text" name="catalog_number" class="border rounded-lg p-2">
            </div>
            <div class="flex flex-col my-2">
                <label for="year">Year:</label>
                <input type="text" name="year" class="border rounded-lg p-2">
            </div>
            <div class="flex flex-col my-2">
                <label for="diameter">Diameter:</label>
                <select name="diameter" class="border rounded-lg p-2">
                    <option value="" disabled selected>Select a diameter</option>
                    <option value="7">7"</option>
                    <option value="10">10"</option>
                    <option value="12">12"</option>
                </select>
            </div>
            <div class="flex flex-col my-2">
                <label for="rpm">RPM:</label>
                <select name="rpm" class="border rounded-lg p-2">
                    <option value="" disabled selected>Select an RPM</option>
                    <option value="33">33</option>
                    <option value="45">45</option>
                    <option value="78">78</option>
                </select>
            </div>
            <div class="flex flex-col my-2">
                <label for="image">Upload Artwork</label>
                <input type="file" name="image">
            </div>
            <button type="submit" class="w-full bg-primary rounded-lg py-2 my-6 text-white font-light hover:opacity-70 transition duration-300 ease">Collect</button>
        </form>
    </section>
@endsection
