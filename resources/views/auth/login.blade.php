@extends('layouts.app')

@section('content')
   <div class="mt-8 w-full flex justify-center">
      <div class="w-full md:w-6/12 bg-gray-200 rounded-lg p-4 md:p-12 shadow">
         <h1 class="font-bold text-3xl">Login</h1>

         <form action="" method="POST">
            @csrf
            <div class="flex flex-col my-4">
               <label for="email" class="font-light py-1">Email:</label>
               <input type="email" name="email" placeholder="folky_dokey@email.com" class="border border-gray-300 rounded-lg p-2 @error('email') border-red-500 @enderror" value="{{ old('email') }}">
               @error('email')
                  <small class="text-red-500">{{ $message }}</small>
               @enderror
            </div>
            <div class="flex flex-col my-4">
               <label for="password" class="font-light py-1">Password:</label>
               <input type="password" name="password" placeholder="********" class="border border-gray-300 rounded-lg p-2 @error('password') border-red-500 @enderror">
               @error('password')
                   <small class="text-red-500">{{ $message }}</small>
               @enderror
            </div>
            <button type="submit" class="w-full py-2 text-white font-light bg-primary rounded-lg hover:bg-opacity-70 transition duration-300 ease">Login</button>
         </form>
         <small class="opacity-70 font-light">Don't have an account? <a href="{{ route('register') }}" class="text-primary">Register</a></small>
      </div>
   </div>
@endsection