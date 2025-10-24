<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdatbazisController;
use App\Http\Controllers\ContactController;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', function () {
    return view('admin');
})->middleware('admin')->name('admin.dashboard');

Route::get('/adatbazis', [AdatbazisController::class, 'index'])
     ->name('adatbazis');

Route::get('/kapcsolat', fn() => view('contact'))->name('contact.show');
Route::post('/kapcsolat', [ContactController::class, 'store'])->name('contact.store');

Route::view('/diagram', 'chart')->name('chart');
Route::get('/chart/os-distribution', function () {
    $rows = DB::table('gep as g')
        ->leftJoin('oprendszer as o', 'o.id', '=', 'g.oprendszerid')
        ->selectRaw('COALESCE(o.nev, "Ismeretlen") as cimke, SUM(COALESCE(g.db,0)) as darab')
        ->groupBy('cimke')
        ->orderByDesc('darab')
        ->get();

    return response()->json([
        'labels'   => $rows->pluck('cimke'),
        'datasets' => [[
            'label' => 'Darab',
            'data'  => $rows->pluck('darab')->map(fn($v)=>(int)$v),
        ]],
    ]);
})->name('chart.os');

/**
 * 3) Átlagár processzor TÍPUS szerint (Top 10) – oszlopdiagram
 *    -> átlag a "gep.ar" mezőből, típus: processzor.tipus
 */
Route::get('/chart/avg-price-by-cpu', function () {
    $rows = DB::table('gep as g')
        ->join('processzor as p', 'p.id', '=', 'g.processzorid')
        ->selectRaw('p.tipus as cpu_tipus, AVG(g.ar) as atlag_ar, COUNT(*) as n')
        ->groupBy('cpu_tipus')
        ->orderByDesc('atlag_ar')
        ->limit(10)
        ->get();

    return response()->json([
        'labels'   => $rows->pluck('cpu_tipus'),
        'datasets' => [[
            'label' => 'Átlagár (HUF)',
            'data'  => $rows->pluck('atlag_ar')->map(fn($v)=>(int)round($v)),
        ]],
    ]);
})->name('chart.priceByCpu');


Route::view('/crud', 'crud.index')->name('crud.index');

Route::middleware('auth')->group(function () {
    /*Route::view('/uzenetek', 'messages')->name('messages.index');*/
    Route::get('/uzenetek', function () {
        $messages = Message::latest()
            ->paginate(15)
            ->withQueryString();

        return view('messages', compact('messages')); // => resources/views/messages.blade.php
    })->name('messages.index');
});


require __DIR__.'/auth.php';
