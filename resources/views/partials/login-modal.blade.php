<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bejelentkezés</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
      </div>

      <div class="modal-body">
        @if ($errors->has('email') || $errors->has('password'))
          <div class="alert alert-danger py-2">
            <ul class="mb-0 ps-3">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="d-grid gap-2">
          @csrf
          <div>
            <label class="form-label">E-mail</label>
            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
          </div>
          <div>
            <label class="form-label">Jelszó</label>
            <input class="form-control" type="password" name="password" required autocomplete="current-password">
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember" name="remember">
            <label class="form-check-label" for="remember">Emlékezz rám</label>
          </div>
          <button type="submit" class="btn btn-primary w-100 mt-1">Belépés</button>
          @if (Route::has('password.request'))
            <a class="text-decoration-none small text-center" href="{{ route('password.request') }}">Elfelejtett jelszó?</a>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Ha hibás bejelentkezés volt, a modal automatikusan nyíljon meg.
    "load" eseményre tesszük, hogy biztosan betöltődjön előtte a Bootstrap bundle. --}}
@if ($errors->has('email') || $errors->has('password'))
  <script>
    window.addEventListener('load', function () {
      var modalEl = document.getElementById('loginModal');
      if (modalEl && window.bootstrap?.Modal) {
        new bootstrap.Modal(modalEl).show();
      }
    });
  </script>
@endif
