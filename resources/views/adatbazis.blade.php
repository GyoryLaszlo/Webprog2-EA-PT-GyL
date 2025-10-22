@extends('layouts.app')
@section('title','Adatbázis')
@section('content')
  <div class="container py-5">
    <h1 class="mb-3">Adatbázis</h1>
    <p class="text-muted">Itt fogjuk ORM-mel megjeleníteni a 3 táblából az adatokat.</p>

    <div class="row g-3">
      <div class="col-md-4">
        <div class="card h-100"><div class="card-body">
          <h5 class="card-title">Tábla #1</h5>
          <p class="mb-0">Helyőrző lista…</p>
        </div></div>
      </div>
      <div class="col-md-4">
        <div class="card h-100"><div class="card-body">
          <h5 class="card-title">Tábla #2</h5>
          <p class="mb-0">Helyőrző lista…</p>
        </div></div>
      </div>
      <div class="col-md-4">
        <div class="card h-100"><div class="card-body">
          <h5 class="card-title">Tábla #3</h5>
          <p class="mb-0">Helyőrző lista…</p>
        </div></div>
      </div>
    </div>
  </div>
@endsection
