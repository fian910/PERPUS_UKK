<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\HomeComponent;
use App\Livewire\AnggotaComponent;
use App\Livewire\DdcComponent;
use App\Livewire\DetailComponent;
use App\Livewire\FormatComponent;
use App\Livewire\LoginComponent;
use App\Livewire\PerpusComponent;
use App\Livewire\JenisAnggotaComponent;
use App\Livewire\PenerbitComponent;
use App\Livewire\PengarangComponent;
use App\Livewire\PustakaComponent;
use App\Livewire\RakComponent;
use App\Livewire\RiwayatTransaksiComponent;
use App\Livewire\TransaksiComponent;
use App\Livewire\UserHomeComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/userhome', UserHomeComponent::class)->name('user');
    Route::get('/riwayat', RiwayatTransaksiComponent::class)->name('riwayat');
    Route::get('/book/{id}', DetailComponent::class)->name('book.detail');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', HomeComponent::class)->name('home');
    Route::get('/transaksi', TransaksiComponent::class)->name('transaksi');
    Route::get('/pustaka', PustakaComponent::class)->name('pustaka');
    Route::get('/ddc', DdcComponent::class)->name('ddc');
    Route::get('/pengarang', PengarangComponent::class)->name('pengarang');
    Route::get('/penerbit', PenerbitComponent::class)->name('penerbit');
    Route::get('/format', FormatComponent::class)->name('format');
    Route::get('/rak', RakComponent::class)->name('rak');
    Route::get('/anggota', AnggotaComponent::class)->name('anggota');
    Route::get('/jenis_anggota', JenisAnggotaComponent::class)->name('jenis_anggota');
    Route::get('/perpus', PerpusComponent::class)->name('perpus');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
