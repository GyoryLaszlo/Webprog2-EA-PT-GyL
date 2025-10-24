@extends('layouts.app')
@section('title','Processzor szerkesztése')

@section('content')
    <div class="container py-4">
        <h1 class="h4 mb-3">Processzor szerkesztése (#{{ $processzor->id }})</h1>

        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">
                    @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul></div>
        @endif

        <form method="post" action="{{ route('crud.processzorok.update',$processzor) }}">
            @method('PUT')
            @include('crud._processzor_form', ['processzor'=>$processzor])
        </form>
    </div>
@endsection
