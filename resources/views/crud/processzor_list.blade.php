@extends('layouts.app')
@section('title','Processzorok – CRUD')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 m-0">Processzorok</h1>
            <a href="{{ route('crud.processzorok.create') }}" class="btn btn-primary">Új processzor</a>
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
                @forelse ($proc as $p)
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

        <div class="mt-3">{{ $proc->links() }}</div>
    </div>
@endsection
