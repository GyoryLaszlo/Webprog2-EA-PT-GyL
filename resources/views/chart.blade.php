@extends('layouts.app')
@section('title', 'Diagramok – Gépek / CPU / OS')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">Termék-statisztikák</h1>

        {{-- 1. sor: balra kördiagram, jobbra leírás --}}
        <div class="row g-4 align-items-stretch">
            <div class="col-12 col-lg-6">
                <div class="card h-100">
                    <div class="card-header fw-semibold">Darabszám OS szerint (SUM(db))</div>
                    <div class="card-body">
                        <canvas id="osChart" style="height:260px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card h-100">
                    <div class="card-header fw-semibold">Leírás</div>
                    <div class="card-body">
                        <p class="mb-2">
                            Ez a kördiagram az <code>oprendszer.nev</code> szerinti megoszlást mutatja.
                            Az értékek a <code>gep.db</code> mező összegei (készlet darabszám).
                        </p>
                        <ul class="mb-0">
                            <li><strong>Forrás táblák:</strong> <code>gep</code> ⟷ <code>oprendszer</code></li>
                            <li><strong>Összesítés:</strong> <code>SUM(gep.db)</code> OS-enként</li>
                            <li><strong>Hiányzó OS:</strong> „Ismeretlen” címkével szerepel</li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">
                            Ez az oszlopdiagram a <code>processzor.tipus</code> szerint csoportosít,
                            és a hozzá tartozó gépek <code>ar</code> mezőjének átlagát mutatja.
                        </p>
                        <ul class="mb-0">
                            <li><strong>Forrás táblák:</strong> <code>gep</code> ⟷ <code>processzor</code></li>
                            <li><strong>Mutató:</strong> <code>AVG(gep.ar)</code> típusonként</li>
                            <li><strong>Megjelenítés:</strong> Top 10 legmagasabb átlagár</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. sor: balra leírás, jobbra oszlopdiagram --}}
        <div class="row g-4 align-items-stretch mt-1">
            <div class="col-12 col-lg-12">
                <div class="card h-100">
                    <div class="card-header fw-semibold">Átlagár processzor típus szerint (Top 10)</div>
                    <div class="card-body">
                        <canvas id="cpuPriceChart" style="height:260px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Mivel a layoutod @yield('scripts')-et használ, itt @section kell --}}
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <script>
        async function fetchJson(url) {
            const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' }});
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return await res.json();
        }

        async function makeChart(id, type, url, tweak=(d)=>d, options={}) {
            const el = document.getElementById(id);
            if (!el) return;
            try {
                const json = await fetchJson(url);
                const ctx = el.getContext('2d');
                const data = {
                    labels: json.labels ?? [],
                    datasets: (json.datasets ?? []).map(ds => tweak({ ...ds, borderWidth: 1 }))
                };
                new Chart(ctx, { type, data, options });
            } catch (e) {
                el.insertAdjacentHTML('afterend',
                    '<div class="text-danger small mt-2">Adatbetöltési hiba: ' + e.message + '</div>');
                console.error(e);
            }
        }

        // 1) OS eloszlás
        makeChart('osChart', 'doughnut', @json(route('chart.os')), d => d, {
            plugins: { legend: { position: 'bottom' } }
        });

        // 2) Átlagár CPU típus szerint
        makeChart('cpuPriceChart', 'bar', @json(route('chart.priceByCpu')), d => ({ ...d, borderWidth: 0 }), {
            responsive: true,
            scales: {
                x: { ticks: { autoSkip: false, maxRotation: 0 } },
                y: {
                    beginAtZero: true,
                    ticks: { callback: v => new Intl.NumberFormat('hu-HU').format(v) + ' Ft' }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: { label: ctx => ' ' + new Intl.NumberFormat('hu-HU').format(ctx.raw) + ' Ft' }
                }
            }
        });
    </script>
@endsection
