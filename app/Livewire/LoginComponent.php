<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email, $password;
    public function render()
    {
        return view('livewire.login-component')->layout('components.layouts.login');
    }

    public function proses()
    {
        $credentials = $this->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Tidak Boleh Kosong!',
            'password.required' => 'Password Tidak Boleh Kosong!'
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            return redirect()->route('home');
        }

        session()->flash('error', 'Autentikasi Gagal!');

        return back()->withErrors([
            'email' => 'Autentikasi Gagal!',
        ])->onlyInput('email');
    }
    public function keluar()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->route('login');
    }
}
