@extends('layouts.app')
@section('title','Kapcsolat')
@section('content')
<div class="container py-5" style="max-width:720px">
  <h1 class="mb-4">Kapcsolat</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('contact.store') }}">
    @csrf

    <div class="mb-3">
      <label class="form-label">Név</label>
      <input name="name" class="form-control @error('name') is-invalid @enderror"
             type="text" placeholder="Teljes név" value="{{ old('name') }}">
      @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">E-mail</label>
      <input name="email" class="form-control @error('email') is-invalid @enderror"
             type="email" placeholder="valaki@example.com" value="{{ old('email') }}">
      @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Tárgy</label>
      <input name="subject" class="form-control @error('subject') is-invalid @enderror"
             type="text" placeholder="Tárgy (opcionális)" value="{{ old('subject') }}">
      @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Üzenet</label>
      <textarea name="body" class="form-control @error('body') is-invalid @enderror"
                rows="5" placeholder="Üzenet…">{{ old('body') }}</textarea>
      @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <input type="text" name="website" style="display:none"> {{-- honeypot --}}

    <button class="btn btn-primary" type="submit">Küldés</button>
  </form>
</div>
@endsection
