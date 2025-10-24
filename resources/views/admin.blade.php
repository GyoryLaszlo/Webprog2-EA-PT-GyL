{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-3">Felhasználók</h1>
        @if(session('status')) <div class="alert alert-success">{{ session('status') }}</div> @endif
        @if(session('error'))  <div class="alert alert-danger">{{ session('error') }}</div>  @endif

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-sm mb-0 align-middle">
                    <thead class="table-light">
                    <tr><th>ID</th><th>Név</th><th>Email</th><th class="text-center">Admin?</th></tr>
                    </thead>
                    <tbody>
                    @foreach($users as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('admin.users.update', $u) }}">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="is_admin" value="0">
                                    <div class="form-check form-switch d-inline-block">
                                        <input class="form-check-input" type="checkbox" name="is_admin" value="1"
                                               onchange="this.form.submit()" @checked($u->is_admin)>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">{{ $users->links() }}</div>
        </div>
    </div>
@endsection
