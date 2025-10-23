{{-- resources/views/messages/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Üzenetek')

@section('content')
    <div class="container py-3">
        <h1 class="h4 mb-3">Elküldött üzeneteim</h1>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0 align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Tárgy</th>
                        <th>Címzett név</th>
                        <th>Címzett e-mail</th>
                        <th class="text-nowrap">Küldés ideje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($messages as $i => $msg)
                        <tr>
                            <td>{{ $messages->firstItem() + $i }}</td>
                            <td class="text-truncate" style="max-width:22rem">{{ $msg->subject ?? '—' }}</td>
                            <td class="text-truncate" style="max-width:14rem">{{ $msg->name }}</td>
                            <td class="text-truncate" style="max-width:18rem">{{ $msg->email }}</td>
                            <td class="text-nowrap">
                                {{ $msg->created_at?->timezone('Europe/Budapest')->format('Y.m.d H:i') }}
                                <small class="text-muted">({{ $msg->created_at?->diffForHumans() }})</small>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted">Még nincs elküldött üzenet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if($messages->hasPages())
                <div class="card-footer">{{ $messages->links() }}</div>
            @endif
        </div>
    </div>
@endsection
