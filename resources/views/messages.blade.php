@extends('layouts.app')
@section('title','Üzenetek')
@section('content')
  <div class="container py-5">
    <h1 class="mb-3">Üzenetek</h1>
    <p class="text-muted">Itt fogjuk listázni az adatbázisba mentett kapcsolat űrlap üzeneteket (csak bejelentkezve).</p>

    <div class="alert alert-info">Még nincs adat. A következő lépésben hozzuk létre a Message modellt és a táblát.</div>

    <table class="table table-striped align-middle">
      <thead><tr><th>#</th><th>Név</th><th>E-mail</th><th>Üzenet</th><th>Dátum</th></tr></thead>
      <tbody>
        <tr><td colspan="5" class="text-muted">Helyőrző sor.</td></tr>
      </tbody>
    </table>
  </div>
@endsection
