@extends('layouts.app')

@section('content')
   <div class="mt-8 w-full flex justify-center">
      <div class="w-full md:w-6/12 bg-gray-200 rounded-lg p-4 md:p-12 shadow">
         <h1 class="font-bold text-3xl">Register</h1>

         <form action="" method="POST">
            @csrf
            <div class="flex flex-col my-4">
               <label for="username" class="font-light py-1">Username:</label>
               <input type="text" name="username" placeholder="folky_dokey" class="auth-input @error('username') border-red-500 @enderror" value="{{ old('username') }}">
               @error('username')
                  <small class="text-red-500">
                     {{ $message }}
                  </small>
               @enderror
            </div>
            <div class="flex flex-col my-4">
               <label for="email" class="font-light py-1">Email:</label>
               <input type="email" name="email" placeholder="folky_dokey@email.com" class="auth-input @error('email') border-red-500 @enderror" value="{{ old('email') }}">
               @error('email')
                  <small class="text-red-500">
                     {{ $message }}
                  </small>
               @enderror
            </div>
            <div class="flex flex-col my-4">
               <label for="password" class="font-light py-1">Password:</label>
               <input type="password" name="password" placeholder="********" class="auth-input @error('password') border-red-500 @enderror">
               @error('password')
                  <small class="text-red-500">
                     {{ $message }}
                  </small>
               @enderror
            </div>
            <div class="flex flex-col my-4">
               <label for="password_confirmation" class="font-light py-1">Confirm password:</label>
               <input type="password" name="password_confirmation" placeholder="********" class="auth-input">
            </div>
            <button type="submit" class="btn-auth">Register</button>
         </form>
         <small class="opacity-70 font-light">Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a></small>
      </div>
   </div>
@endsection
