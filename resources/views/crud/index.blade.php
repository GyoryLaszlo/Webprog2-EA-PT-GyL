{{-- ======= PROCESSZOR CRUD BLOKK (csak ha a controller ezt kéri) ======= --}}
@extends('layouts.app')   {{-- vagy ami a layout fájlod neve/útvonala --}}
@section('title','CRUD')
@section('content')
@if (($procMode ?? null) === 'list')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 m-0">Processzorok</h2>
        <a href="{{ route('crud.processzorok.create') }}" class="btn btn-primary btn-sm">Új processzor</a>
    </div>

    @if(session('ok'))  <div class="alert alert-success">{{ session('ok') }}</div> @endif
    @if(session('err')) <div class="alert alert-danger">{{ session('err') }}</div> @endif

    <div class="table-responsive">
        <table class="table table-sm table-hover align-middle">
            <thead>
            <tr>
                <th style="width:6rem">#</th>
                <th>Gyártó</th>
                <th>Típus</th>
                <th style="width:10rem" class="text-end">Műveletek</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($proc ?? [] as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->gyarto }}</td>
                    <td>{{ $p->tipus }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('crud.processzorok.edit',$p) }}">Szerk.</a>
                        <form action="{{ route('crud.processzorok.destroy',$p) }}" method="post" class="d-inline"
                              onsubmit="return confirm('Biztosan törlöd?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Törlés</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-muted">Nincs adat.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ ($proc ?? null)?->links() }}</div>
@endif

@if (($procMode ?? null) === 'create')
    <h2 class="h5 mb-3">Új processzor</h2>
    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">
                @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul></div>
    @endif
    <form method="post" action="{{ route('crud.processzorok.store') }}">
        @include('crud._processzor_form')
    </form>
@endif

@if (($procMode ?? null) === 'edit')
    <h2 class="h5 mb-3">Processzor szerkesztése (#{{ $processzor->id ?? '' }})</h2>
    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">
                @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul></div>
    @endif
    <form method="post" action="{{ route('crud.processzorok.update', $processzor ?? '') }}">
        @method('PUT')
        @include('crud._processzor_form', ['processzor' => $processzor ?? null])
    </form>
@endif
@endsection
{{-- ======= /PROCESSZOR CRUD BLOKK ======= --}}
