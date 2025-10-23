<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdatbazisController;
use App\Http\Controllers\ContactController;
use App\Models\Message;


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
