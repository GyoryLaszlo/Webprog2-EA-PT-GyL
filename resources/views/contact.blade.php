@extends('layouts.app')
@section('title','Kapcsolat')
@section('content')
  <div class="container py-5" style="max-width:720px">
    <h1 class="mb-4">Kapcsolat</h1>
    <p class="text-muted mb-4">Ide kerül majd a valódi űrlap validációval és DB-mentéssel.</p>

    <form>
      <div class="mb-3">
        <label class="form-label">Név</label>
        <input class="form-control" type="text" placeholder="Teljes név" disabled>
      </div>
      <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input class="form-control" type="email" placeholder="valaki@example.com" disabled>
      </div>
      <div class="mb-3">
        <label class="form-label">Üzenet</label>
        <textarea class="form-control" rows="5" placeholder="Üzenet…" disabled></textarea>
      </div>
      <button class="btn btn-primary" type="button" disabled>Küldés (hamarosan)</button>
    </form>
  </div>
@endsection
