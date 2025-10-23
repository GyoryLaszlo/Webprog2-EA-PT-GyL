@extends('layouts.app')

@section('content')
<h1>Gépek</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Gyártó</th><th>Típus</th><th>Kijelző</th>
      <th>Memória</th><th>HDD</th><th>VGA</th>
      <th>Processzor</th><th>OS</th><th>Ár</th><th>Db</th>
    </tr>
  </thead>
  <tbody>
  @foreach($gepek as $g)
    <tr>
      <td>{{ $g->gyarto }}</td>
      <td>{{ $g->tipus }}</td>
      <td>{{ $g->kijelzo }}</td>
      <td>{{ $g->memoria }} MB</td>
      <td>{{ $g->merevlemez }} GB</td>
      <td>{{ $g->videovezerlo }}</td>
      <td>{{ $g->processzor->gyarto }} {{ $g->processzor->tipus }}</td>
      <td>{{ $g->oprendszer->nev }}</td>
      <td>{{ number_format($g->ar,0,'',' ') }} Ft</td>
      <td>{{ $g->db }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
{{ $gepek->links() }}
@endsection
