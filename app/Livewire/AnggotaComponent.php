<?php

namespace App\Livewire;

use App\Models\Anggota;
use App\Models\JenisAnggota;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class AnggotaComponent extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $jenis_anggota_id, $kode_anggota, $nama_anggota, $tempat, $tgl_lahir, $alamat, $no_telp, $email, $tgl_daftar, $masa_aktif, $fa, $keterangan, $foto, $username, $password, $id, $cari;
    public function render()
    {
        $layout['title'] = "Kelola Anggota";
        if ($this->cari) {
            $data['anggota'] = Anggota::where('kode_anggota', 'like', '%' . $this->cari . '%')
                ->orwhere('nama_anggota', 'like', '%' . $this->cari . '%')
                ->paginate(5);
        } else {
            $data['anggota'] = Anggota::paginate(5);
        }
        $data['jenis_anggota'] = JenisAnggota::all();
        return view('livewire.admin.anggota-component', $data)
            ->extends('components.layouts.app')
            ->section('content')
            ->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'jenis_anggota_id' => 'required|exists:jenis_anggotas,id',
            'kode_anggota' => 'required|string|unique:anggotas,kode_anggota',
            'nama_anggota' => 'required|string|max:255',
            'tempat' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'required|email|unique:anggotas,email',
            'tgl_daftar' => 'required|date',
            'masa_aktif' => 'required|date',
            'fa' => 'nullable|in:Y,T',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'username' => 'required|string|unique:anggotas,username|min:4',
            'password' => 'required',
        ], [
            'jenis_anggota_id.required' => 'ID jenis anggota wajib diisi.',
            'jenis_anggota_id.exists' => 'ID jenis anggota tidak valid.',

            'kode_anggota.required' => 'Kode anggota wajib diisi.',
            'kode_anggota.string' => 'Kode anggota harus berupa string.',
            'kode_anggota.unique' => 'Kode anggota sudah terdaftar.',

            'nama_anggota.required' => 'Nama anggota wajib diisi.',
            'nama_anggota.string' => 'Nama anggota harus berupa string.',
            'nama_anggota.max' => 'Nama anggota maksimal 255 karakter.',

            'tempat.string' => 'Tempat harus berupa string.',
            'tempat.max' => 'Tempat maksimal 255 karakter.',

            'tgl_lahir.date' => 'Format tanggal lahir tidak valid.',

            'alamat.string' => 'Alamat harus berupa string.',

            'no_telp.string' => 'Nomor telepon harus berupa string.',
            'no_telp.max' => 'Nomor telepon maksimal 15 karakter.',
            'no_telp.regex' => 'Nomor telepon tidak valid.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',

            'tgl_daftar.required' => 'Tanggal daftar wajib diisi.',
            'tgl_daftar.date' => 'Format tanggal daftar tidak valid.',

            'masa_aktif.required' => 'Masa aktif wajib diisi.',
            'masa_aktif.date' => 'Format masa aktif tidak valid.',

            'fa.string' => 'Fa harus berupa string.',
            'fa.max' => 'Fa maksimal 255 karakter.',

            'keterangan.string' => 'Keterangan harus berupa string.',

            'foto.image' => 'Format file foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus memiliki format jpeg, png, atau jpg.',
            'foto.max' => 'Ukuran foto maksimal 2048 KB.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa string.',
            'username.unique' => 'Username sudah terdaftar.',
            'username.min' => 'Username minimal 4 karakter.',

            'password.required' => 'Password wajib diisi.'
        ]);

        $namaFoto = $this->kode_anggota . '_' . time() . '.' . $this->foto->getClientOriginalExtension();
        $pathFoto = $this->foto->storeAs('fotos', $namaFoto, 'public');

        Anggota::create([
            'jenis_anggota_id' => $this->jenis_anggota_id,
            'kode_anggota' => $this->kode_anggota,
            'nama_anggota' => $this->nama_anggota,
            'tempat' => $this->tempat,
            'tgl_lahir' => $this->tgl_lahir,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
            'tgl_daftar' => $this->tgl_daftar,
            'masa_aktif' => $this->masa_aktif,
            'fa' => $this->fa,
            'keterangan' => $this->keterangan,
            'foto' => $pathFoto,
            'username' => $this->username,
            'password' => Hash::make($this->password),
        ]);
        $this->reset();
        session()->flash('Success', 'Berhasil Disimpan!');
        return redirect()->route('anggota');
    }

    public function edit($id)
    {
        $anggota = Anggota::find($id);
        $this->id = $anggota->id;
        $this->jenis_anggota_id = $anggota->jenis_anggota_id; // Ambil ID langsung
        $this->kode_anggota = $anggota->kode_anggota;
        $this->nama_anggota = $anggota->nama_anggota;
        $this->tempat = $anggota->tempat;
        $this->tgl_lahir = $anggota->tgl_lahir;
        $this->alamat = $anggota->alamat;
        $this->no_telp = $anggota->no_telp;
        $this->email = $anggota->email;
        $this->tgl_daftar = $anggota->tgl_daftar;
        $this->masa_aktif = $anggota->masa_aktif;
        $this->fa = $anggota->fa;
        $this->keterangan = $anggota->keterangan;
        $this->foto = $anggota->foto;
        $this->username = $anggota->username;
    }

    public function update()
    {
        $this->validate([
            'jenis_anggota_id' => 'required|exists:jenis_anggotas,id',
            'kode_anggota' => 'required|string|unique:anggotas,kode_anggota',
            'nama_anggota' => 'required|string|max:255',
            'tempat' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'required|email|unique:anggotas,email',
            'tgl_daftar' => 'required|date',
            'masa_aktif' => 'required|date',
            'fa' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'username' => 'required|string|unique:anggotas,username|min:4',
            'password' => 'required',
        ], [
            'jenis_anggota_id.required' => 'ID jenis anggota wajib diisi.',
            'jenis_anggota_id.exists' => 'ID jenis anggota tidak valid.',

            'kode_anggota.required' => 'Kode anggota wajib diisi.',
            'kode_anggota.string' => 'Kode anggota harus berupa string.',
            'kode_anggota.unique' => 'Kode anggota sudah terdaftar.',

            'nama_anggota.required' => 'Nama anggota wajib diisi.',
            'nama_anggota.string' => 'Nama anggota harus berupa string.',
            'nama_anggota.max' => 'Nama anggota maksimal 255 karakter.',

            'tempat.string' => 'Tempat harus berupa string.',
            'tempat.max' => 'Tempat maksimal 255 karakter.',

            'tgl_lahir.date' => 'Format tanggal lahir tidak valid.',

            'alamat.string' => 'Alamat harus berupa string.',

            'no_telp.string' => 'Nomor telepon harus berupa string.',
            'no_telp.max' => 'Nomor telepon maksimal 15 karakter.',
            'no_telp.regex' => 'Nomor telepon tidak valid.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',

            'tgl_daftar.required' => 'Tanggal daftar wajib diisi.',
            'tgl_daftar.date' => 'Format tanggal daftar tidak valid.',

            'masa_aktif.required' => 'Masa aktif wajib diisi.',
            'masa_aktif.date' => 'Format masa aktif tidak valid.',

            'fa.string' => 'Fa harus berupa string.',
            'fa.max' => 'Fa maksimal 255 karakter.',

            'keterangan.string' => 'Keterangan harus berupa string.',

            'foto.image' => 'Format file foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus memiliki format jpeg, png, atau jpg.',
            'foto.max' => 'Ukuran foto maksimal 2048 KB.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa string.',
            'username.unique' => 'Username sudah terdaftar.',
            'username.min' => 'Username minimal 4 karakter.',

            'password.required' => 'Password wajib diisi.'
        ]);

        $anggota = Anggota::find($this->id);

        if (!$anggota) {
            session()->flash('error', 'Anggota tidak ditemukan!');
            return;
        }

        if ($this->foto) {
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }

            $namaFoto = $this->kode_anggota . '_' . time() . '.' . $this->foto->getClientOriginalExtension();
            $pathFoto = $this->foto->storeAs('fotos', $namaFoto, 'public');
        } else {
            $pathFoto = $anggota->foto;
        }

        if ($this->password == "") {
            $anggota->update([
                'jenis_anggota_id' => $this->jenis_anggota_id,
                'kode_anggota' => $this->kode_anggota,
                'nama_anggota' => $this->nama_anggota,
                'tempat' => $this->tempat,
                'tgl_lahir' => $this->tgl_lahir,
                'alamat' => $this->alamat,
                'no_telp' => $this->no_telp,
                'email' => $this->email,
                'tgl_daftar' => $this->tgl_daftar,
                'masa_aktif' => $this->masa_aktif,
                'fa' => $this->fa,
                'keterangan' => $this->keterangan,
                'foto' => $pathFoto,
                'username' => $this->username,
            ]);
        } else {
            $anggota->update([
                'jenis_anggota_id' => $this->jenis_anggota_id,
                'kode_anggota' => $this->kode_anggota,
                'nama_anggota' => $this->nama_anggota,
                'tempat' => $this->tempat,
                'tgl_lahir' => $this->tgl_lahir,
                'alamat' => $this->alamat,
                'no_telp' => $this->no_telp,
                'email' => $this->email,
                'tgl_daftar' => $this->tgl_daftar,
                'masa_aktif' => $this->masa_aktif,
                'fa' => $this->fa,
                'keterangan' => $this->keterangan,
                'foto' => $pathFoto,
                'username' => $this->username,
                'password' => $this->password,
            ]);
        }
        $this->reset();
        session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('anggota');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $anggota = Anggota::find($this->id);
        $anggota->delete();
        $this->reset();
        session()->flash('success', 'Data Berhasil Dihapus!');
        return redirect()->route('anggota');
    }
}
