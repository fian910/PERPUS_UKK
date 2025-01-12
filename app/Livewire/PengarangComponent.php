<?php

namespace App\Livewire;

use App\Models\Pengarang;
use Livewire\Component;

class PengarangComponent extends Component
{
    public $kode_pengarang, $gelar_depan, $nama_pengarang, $gelar_belakang, $no_telp, $email, $website, $biografi, $keterangan, $id;
    public function render()
    {
        $layout['title'] = "Kelola Pengarang";
        $data['pengarang'] = Pengarang::all();
        return view('livewire.pengarang-component', $data)->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'kode_pengarang' => 'required|string|unique:pengarangs,kode_pengarang|max:10',
            'gelar_depan' => 'required|string|max:50',
            'nama_pengarang' => 'required|string|unique:pengarangs,nama_pengarang|max:100',
            'gelar_belakang' => 'required|string|max:50',
            'no_telp' => 'required|string|max:15|regex:/^[0-9\-\+]+$/',
            'email' => 'required|email',
            'website' => 'required|url|max:100',
            'biografi' => 'required|string|max:1000',
            'keterangan' => 'required|string|max:255',
        ], [
            'kode_pengarang.required' => 'Kode pengarang wajib diisi',
            'kode_pengarang.string' => 'Kode pengarang harus berupa teks',
            'kode_pengarang.unique' => 'Kode pengarang sudah digunakan',
            'kode_pengarang.max' => 'Kode pengarang maksimal 10 karakter',

            'nama_pengarang.required' => 'Nama pengarang wajib diisi',
            'nama_pengarang.string' => 'Nama pengarang harus berupa teks',
            'nama_pengarang.max' => 'Nama pengarang maksimal 100 karakter',

            'gelar_depan.string' => 'Gelar depan harus berupa teks',
            'gelar_depan.max' => 'Gelar depan maksimal 50 karakter',

            'gelar_belakang.string' => 'Gelar belakang harus berupa teks',
            'gelar_belakang.max' => 'Gelar belakang maksimal 50 karakter',

            'no_telp.required' => 'Nomor telepon wajib diisi',
            'no_telp.string' => 'Nomor telepon harus berupa teks',
            'no_telp.max' => 'Nomor telepon maksimal 15 karakter',
            'no_telp.regex' => 'Format nomor telepon tidak valid',

            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email maksimal 100 karakter',
            'email.unique' => 'Email sudah digunakan',

            'website.url' => 'Format website tidak valid',
            'website.max' => 'Website maksimal 100 karakter',

            'biografi.required' => 'Biografi wajib diisi',
            'biografi.string' => 'Biografi harus berupa teks',
            'biografi.max' => 'Biografi maksimal 1000 karakter',

            'keterangan.string' => 'Keterangan harus berupa teks',
            'keterangan.max' => 'Keterangan maksimal 255 karakter'
        ]);
        Pengarang::create([
            'kode_pengarang' => $this->kode_pengarang,
            'gelar_depan' => $this->gelar_depan,
            'nama_pengarang' => $this->nama_pengarang,
            'gelar_belakang' => $this->gelar_belakang,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
            'website' => $this->website,
            'biografi' => $this->biografi,
            'keterangan' => $this->keterangan,
        ]);
        $this->reset();
        session()->flash('Success', 'Berhasil Disimpan!');
        return redirect()->route('pengarang');
    }

    public function edit($id)
    {
        $pengarang = Pengarang::find($id);
        $this->kode_pengarang = $pengarang->kode_pengarang;
        $this->gelar_depan = $pengarang->gelar_depan;
        $this->nama_pengarang = $pengarang->nama_pengarang;
        $this->gelar_belakang = $pengarang->gelar_belakang;
        $this->no_telp = $pengarang->no_telp;
        $this->email = $pengarang->email;
        $this->website = $pengarang->website;
        $this->biografi = $pengarang->biografi;
        $this->keterangan = $pengarang->keterangan;
        $this->id = $pengarang->id;
    }

    public function update()
    {
        $pengarang = Pengarang::find($this->id);
        $pengarang->update([
            'kode_pengarang' => $this->kode_pengarang,
            'gelar_depan' => $this->gelar_depan,
            'nama_pengarang' => $this->nama_pengarang,
            'gelar_belakang' => $this->gelar_belakang,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
            'website' => $this->website,
            'biografi' => $this->biografi,
            'keterangan' => $this->keterangan,
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('pengarang');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $pengarang = Pengarang::find($this->id);
        $pengarang->delete();
        $this->reset();
        session()->flash('success', 'Data Berhasil Dihapus!');
        return redirect()->route('pengarang');
    }
}
