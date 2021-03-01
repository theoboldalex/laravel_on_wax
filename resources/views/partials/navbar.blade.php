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
          <a href="{{ route('create', auth()->user()->username) }}" class="hover:opacity-70 transition duration-300 ease">Add to collection</a>
          <a href="{{ route('profile', auth()->user()->username) }}" class="ml-6 hover:opacity-70 transition duration 300 ease">Profile</a>
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="ml-6 hover:opacity-70 transition duration 300 ease">Logout</button>
          </form>
      @endauth
    </div>
  </div>
</nav>