<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
  <div class="container px-4 px-lg-5">
    <a class="navbar-brand" href="{{ route('home') }}">Notebooks</a>

    <button class="navbar-toggler navbar-toggler-right" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav me-auto my-2 my-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Főoldal</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('adatbazis') }}">Adatbázis</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('contact.show') }}">Kapcsolat</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('chart') }}">Diagram</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('crud.index') }}">CRUD</a></li>
        @auth
          <li class="nav-item"><a class="nav-link" href="{{ route('messages.index') }}">Üzenetek</a></li>
          
          @if(Auth::user()->is_admin ?? false)
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
          @endif
        @endauth
      </ul>

      <ul class="navbar-nav ms-lg-3">
        @guest
          <li class="nav-item me-2">
            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">
              Bejelentkezés
            </button>
          </li>
          <li class="nav-item">
              <button class="btn btn-outline-dark btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#registerModal">
                Regisztráció
              </button>
          </li>
        @endguest

        @auth
          <li class="nav-item d-flex align-items-center me-2"><span class="small">Szia, {{ Auth::user()->name }}!</span></li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-outline-dark btn-sm" type="submit">Kijelentkezés</button>
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
