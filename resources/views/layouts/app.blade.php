<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <title>On Wax</title>
</head>
<body>
  <header>
    @include('partials.navbar')
  </header>
  <main class="mx-4 md:mx-40">
    @yield('content')
  </main>
  {{-- <footer>
    @include('partials.footer')
  </footer> --}}
</body>
</html>