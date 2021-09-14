@extends('layouts.app')

@section('content')
    <div class="flex justify-center" id="alert">
        @if (session('status'))
            <div class="w-6/12 py-2 border border-red-500 rounded-lg bg-red-200 text-red-800 text-center mt-4">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="mt-8 w-full flex justify-center">
        <div class="w-full md:w-6/12 bg-gray-200 rounded-lg p-4 md:p-12 shadow">
            <h1 class="font-bold text-3xl">Login</h1>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="flex flex-col my-4">
                    <label for="email" class="font-light py-1">Email:</label>
                    <input type="email" name="email" placeholder="folky_dokey@email.com"
                           class="auth-input @error('email') border-red-500 @enderror"
                           value="{{ old('email') }}">
                    @error('email')
                    <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="flex flex-col my-4">
                    <label for="password" class="font-light py-1">Password:</label>
                    <input type="password" name="password" placeholder="********"
                           class="auth-input @error('password') border-red-500 @enderror">
                    @error('password')
                    <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit"
                        class="btn-auth">
                    Login
                </button>
            </form>
            <small class="opacity-70 font-light">Don't have an account? <a href="{{ route('register') }}"
                                                                           class="text-primary">Register</a></small>
        </div>
    </div>

    <script>
        const alert = document.querySelector('#alert');

        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000);
    </script>
@endsection
