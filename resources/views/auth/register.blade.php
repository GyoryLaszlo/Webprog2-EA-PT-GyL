@extends('layouts.app')
@section('title','Regisztráció')

@section('content')
<div class="container py-5" style="max-width:720px">
  <h1 class="mb-4">Regisztráció</h1>

  {{-- Hibák --}}
  @if ($errors->any())
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
      <input class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus>
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

    <div class="col-12 d-flex align-items-center justify-content-between mt-3">
      <a href="{{ route('login') }}" class="link-secondary" onclick="event.preventDefault(); document.getElementById('openLoginViaLink').click();">
        Már van fiókod? Jelentkezz be!
      </a>
      <button class="btn btn-primary" type="submit">Regisztráció</button>
    </div>
  </form>
</div>

{{-- rejtett gomb a login modal megnyitásához (ha akarod) --}}
<button id="openLoginViaLink" type="button" class="d-none" data-bs-toggle="modal" data-bs-target="#loginModal"></button>
@endsection
