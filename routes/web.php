<?php

use App\Livewire\HomeComponent;
use App\Livewire\LoginComponent;
use App\Livewire\PerpusComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeComponent::class)->middleware('auth')->name('home');
Route::get('/perpus',PerpusComponent::class)->name('perpus')->middleware('auth');

Route::get('/login', LoginComponent::class)->name('login');
Route::get('/logout', LoginComponent::class, 'keluar')->name('logout');
