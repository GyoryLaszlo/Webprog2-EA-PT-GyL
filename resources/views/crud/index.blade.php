@extends('layouts.app')
@section('title','CRUD')
@section('content')
  <div class="container py-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h1 class="mb-0">CRUD példa tábla</h1>
      <a href="#" class="btn btn-primary disabled">+ Új rekord (hamarosan)</a>
    </div>

    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>#</th><th>Név</th><th>Leírás</th><th class="text-end">Műveletek</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td><td>Minta elem</td><td>Helyőrző leírás</td>
          <td class="text-end">
            <a href="#" class="btn btn-sm btn-outline-secondary disabled">Szerkesztés</a>
            <button class="btn btn-sm btn-outline-danger disabled">Törlés</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection
