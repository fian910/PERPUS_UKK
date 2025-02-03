<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Anggota;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'username' => ['required', 'string', 'unique:anggotas,username', 'min:4'],
        ]);

        // Create User
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create corresponding Anggota
        $kodeAnggota = 'REG-' . time(); // Generate a simple unique code

        Anggota::create([
            'kode_anggota' => $kodeAnggota,
            'nama_anggota' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'tgl_daftar' => now(),
            'masa_aktif' => now()->addYear(), // Set default masa_aktif to 1 year from registration
            'jenis_anggota_id' => 1, // Set default jenis_anggota_id, adjust as needed
            // Required fields with default values
            'tgl_lahir' => now(),
            'fa' => 'Y', // Set a default value for 'fa' (either 'Y' or 'T')
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($user->role === "admin") {
            return redirect()->route('home');
        }

        return redirect()->route('user'); // halaman default untuk non-admin
    }
}
