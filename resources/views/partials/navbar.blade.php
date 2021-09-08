<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<div class="w-full text-gray-700 bg-primary z-50">
    <div x-data="{ open: false }" class="flex flex-col mx-4 md:mx-40 md:items-center md:justify-between md:flex-row">
        <div class="py-4 flex flex-row items-center justify-between">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logo.png') }}" alt="site logo" width="100">
            </a>
            <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row md:items-center">
            @guest
                <a class="text-sm font-semibold hover:text-opacity-50 py-2" href="{{ route('login') }}">Login</a>
                <a class="text-sm font-semibold hover:text-opacity-50 py-2 md:ml-4" href="{{ route('register') }}">Register</a>
            @endguest
            @auth
                <a class="text-sm font-semibold bg-gray-200 px-4 py-2 rounded-lg hover:bg-opacity-80 transition duration-300 ease-in-out" href="{{ route('create', auth()->user()->username) }}">+ New Record</a>
                <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex flex-row items-center w-full py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg md:w-auto md:inline md:mt-0 md:ml-4 focus:outline-none">
                        <span>
                            <img src="{{ Storage::disk('s3')->url('public/avatar/' . auth()->user()->avatar) }}" alt="profile image" width="30" class="rounded-full inline">
                        </span>
                        <svg fill="currentColor" viewBox="0 0 16 16" class="inline w-4 h-4 mt-1 md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800 z-50">
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('profile', auth()->user()->username) }}">Profile</a>
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('edit_profile', auth()->user()->username) }}">Settings</a>
                            <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 mt-2 mb-0 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                @csrf
                                <button type="submit" class="font-semibold h-full w-full text-left">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </nav>
    </div>
</div>
