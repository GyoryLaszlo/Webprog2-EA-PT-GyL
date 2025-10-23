<div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Regisztráció</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
      </div>
      <div class="modal-body">
        @if ($errors->any() && request()->is('register')) {{-- ha reg hibával jöttünk vissza --}}
          <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="row g-3">
          @csrf
          <div class="col-12">
            <label class="form-label">Név</label>
            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
          </div>
          <div class="col-12">
            <label class="form-label">E-mail</label>
            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Jelszó</label>
            <input class="form-control" type="password" name="password" required autocomplete="new-password">
          </div>
          <div class="col-md-6">
            <label class="form-label">Jelszó megerősítése</label>
            <input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
          </div>
          <div class="col-12 d-grid">
            <button class="btn btn-primary" type="submit">Regisztráció</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- ha /register POST hibával jött vissza, nyissuk ki automatikusan --}}
@if ($errors->any() && request()->is('register'))
  <script>
    window.addEventListener('load', function () {
      var el = document.getElementById('registerModal');
      if (el && window.bootstrap?.Modal) new bootstrap.Modal(el).show();
    });
  </script>
@endif
