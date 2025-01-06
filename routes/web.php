<?php

use App\Livewire\HomeComponent;
use App\Livewire\LoginComponent;
use App\Livewire\PerpusComponent;
use App\Livewire\JenisAnggotaComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeComponent::class)->middleware('auth')->name('home');

Route::get('/jenis_anggota', JenisAnggotaComponent::class)->name('jenis_anggota');
Route::get('/perpus',PerpusComponent::class)->name('perpus');
Route::get('/login', LoginComponent::class)->name('login');
Route::get('/logout', LoginComponent::class, 'keluar')->name('logout');
