<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\HomeComponent;
use App\Livewire\AnggotaComponent;
use App\Livewire\LoginComponent;
use App\Livewire\PerpusComponent;
use App\Livewire\JenisAnggotaComponent;
use App\Livewire\RakComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', HomeComponent::class)->middleware('auth', 'verified')->name('home');


Route::get('/rak', RakComponent::class)->name('rak');
Route::get('/anggota', AnggotaComponent::class)->name('anggota');
Route::get('/jenis_anggota', JenisAnggotaComponent::class)->name('jenis_anggota');
Route::get('/perpus',PerpusComponent::class)->name('perpus');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
