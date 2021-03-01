@extends('layouts.app')

@section('content')
   <div class="mt-8 w-full flex justify-center">
      <div class="w-6/12 bg-gray-200 rounded-lg p-12 shadow">
         <h1 class="font-bold text-3xl">Register</h1>

         <form action="" method="POST">
            @csrf
            <div class="flex flex-col my-4">
               <label for="username" class="font-light py-1">Username:</label>
               <input type="text" name="username" placeholder="folky_dokey" class="border border-gray-300 rounded-lg p-2">
            </div>
            <div class="flex flex-col my-4">
               <label for="email" class="font-light py-1">Email:</label>
               <input type="email" name="email" placeholder="folky_dokey@email.com" class="border border-gray-300 rounded-lg p-2">
            </div>
            <div class="flex flex-col my-4">
               <label for="password" class="font-light py-1">Password:</label>
               <input type="password" name="password" placeholder="********" class="border border-gray-300 rounded-lg p-2">
            </div>
            <div class="flex flex-col my-4">
               <label for="password_confirmation" class="font-light py-1">Confirm password:</label>
               <input type="password" name="password_confirmation" placeholder="********" class="border border-gray-300 rounded-lg p-2">
            </div>
            <button type="submit" class="w-full py-2 text-white font-light bg-primary rounded-lg hover:bg-opacity-70 transition duration-300 ease">Register</button>
         </form>
      </div>
   </div>
@endsection