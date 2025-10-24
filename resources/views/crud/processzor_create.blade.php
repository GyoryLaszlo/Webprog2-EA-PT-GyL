@extends('layouts.app')
@section('title','Új processzor')

@section('content')
    <div class="container py-4">
        <h1 class="h4 mb-3">Új processzor</h1>

        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">
                    @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul></div>
        @endif

        <form method="post" action="{{ route('crud.processzorok.store') }}">
            @include('crud._processzor_form')
        </form>
    </div>
@endsection
