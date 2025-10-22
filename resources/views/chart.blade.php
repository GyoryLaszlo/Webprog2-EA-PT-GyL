@extends('layouts.app')
@section('title','Diagram')
@section('content')
  <div class="container py-5">
    <h1 class="mb-4">Diagram</h1>
    <p class="text-muted">Minta Chart.js oszlopdiagram; hamarosan DB-adatokkal töltjük.</p>
    <canvas id="chartCanvas" height="140"></canvas>
  </div>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('chartCanvas');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Jan','Feb','Már','Ápr','Máj','Jún'],
        datasets: [{ label: 'Minta', data: [5,9,7,11,6,13] }]
      }
    });
  </script>
@endsection
