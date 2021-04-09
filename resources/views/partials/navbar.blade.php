<nav class="h-16 bg-primary shadow">
  <div class="mx-4 md:mx-40 h-full flex justify-between items-center">
    <a href="{{ route('home') }}">
      <img src="{{ asset('img/logo.png') }}" alt="site logo" width="150">
    </a>
    <div class="flex">
      @guest
        <a href="{{ route('login') }}" class="ml-6 hover:opacity-70 transition duration 300 ease">Login</a>
        <a href="{{ route('register') }}" class="ml-6 hover:opacity-70 transition duration 300 ease">Register</a>
      @endguest
      @auth
          <a href="{{ route('create', auth()->user()->username) }}" class="hover:opacity-70 transition duration-300 ease">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
          </a>
          <a href="{{ route('profile', auth()->user()->username) }}" class="ml-6 hover:opacity-70 transition duration 300 ease">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
          </a>
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="ml-6 hover:opacity-70 transition duration 300 ease">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>
          </form>
      @endauth
    </div>
  </div>
</nav>
