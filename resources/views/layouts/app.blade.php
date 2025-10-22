<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','Notebooks')</title>

  <!-- Creative / Bootstrap head -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>
<body id="page-top">
  @include('partials.navbar')

  <main>
    @yield('content')
  </main>

  <!-- JS (sorrend fontos!) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
  <script src="{{ asset('js/scripts.js') }}"></script>
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

  {{-- MODALOKAT MINDIG IDE TEGYÜK, A SZKRIPTEK UTÁN, HOGY A BOOTSTRAP MÁR ELÉRHETŐ LEGYEN --}}
  @include('partials.login-modal')

  @yield('scripts')
</body>
</html>
