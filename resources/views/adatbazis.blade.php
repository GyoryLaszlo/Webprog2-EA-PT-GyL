@extends('layouts.app')

@section('title', 'Notebook kínálat')

@push('styles')
<style>
  /* finom modernítés */
  .table thead th { position: sticky; top: 0; background: #fff; z-index: 1; }
  .table-hover tbody tr:hover { filter: brightness(0.98); }
  .qty-badge { font-size: .85rem; }
 
  .card-body, .card-header, .card-footer {
    font-size: 0.9rem;
  }
/* OS oszlop: keskenyebb + kisebb betű */
.table.table-sm td.col-os,
.table.table-sm th.col-os {
  width: 7.5rem;
  max-width: 7.5rem;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  font-size: 0.7rem !important; /* kényszerít */
  line-height: 1.2;
}

/* Ár: fix hely és ne törjön */
.table.table-sm td.price,
.table.table-sm th.price {
  min-width: 10rem;
  white-space: nowrap;
}
</style>
@endpush

@section('content')
<div class="card shadow-sm small">
  <div class="card-header bg-white py-2 px-3">
    <h1 class="h6 mb-0">Notebook kínálat</h1>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Gyártó</th>
            <th>Típus</th>
            <th>Kijelző</th>
            <th>Memória</th>
            <th>HDD</th>
            <th>VGA</th>
            <th>Processzor</th>
            <th>OS</th>
            <th class="text-end">Ár</th>
            <th class="text-center">Db</th>
          </tr>
        </thead>
        <tbody>
          @forelse($gepek as $g)
            <tr>
              <td class="fw-medium">{{ $g->gyarto }}</td>
              <td class="text-muted">{{ $g->tipus }}</td>
              <td>{{ $g->kijelzo }}</td>
              <td><span class="badge text-bg-light">{{ $g->memoria }} MB</span></td>
              <td><span class="badge text-bg-light">{{ $g->merevlemez }} GB</span></td>
              <td>{{ $g->videovezerlo }}</td>
              <td>{{ $g->processzor->gyarto }} {{ $g->processzor->tipus }}</td>
              <td class="col-os" style="width:6.5rem"><small class="text-muted">{{ $g->oprendszer->nev }}</small></td>
              <td class="text-end price">{{ number_format($g->ar, 0, '', ' ') }} Ft</td>
              <td class="text-center">
                @php $qty = (int) $g->db; @endphp
                <span class="badge {{ $qty ? 'text-bg-success' : 'text-bg-danger' }} qty-badge">
                  {{ $qty }}
                </span>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="10" class="text-center text-muted py-4">Nincs megjeleníthető termék.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

  @if($gepek->hasPages())
    <div class="card-footer bg-white">
      <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <small class="text-muted">
          {{ $gepek->firstItem() }}–{{ $gepek->lastItem() }} / {{ $gepek->total() }}
        </small>
        <div class="ms-auto">
          {{ $gepek->onEachSide(1)->links() }}
        </div>
      </div>
    </div>
  @endif
</div>
@endsection
