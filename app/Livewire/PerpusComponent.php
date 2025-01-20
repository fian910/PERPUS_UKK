<?php

namespace App\Livewire;

use App\Models\Perpustakaan;
use Livewire\Component;

class PerpusComponent extends Component
{
    public $nama_perpustakaan, $nama_pustakawan, $alamat, $email, $website, $no_telp, $keterangan, $id, $cari;
    public function render()
    {
        $layout['title'] = "Kelola Perpustakaan";
        if ($this->cari) {
            $data['perpustakaan'] = Perpustakaan::where('nama_perpustakaan', 'like', '%' . $this->cari . '%')
                ->orwhere('nama_pustakawan', 'like', '%' . $this->cari . '%')
                ->get();
        } else {
            $data['perpustakaan'] = Perpustakaan::all();
        }
        return view('livewire.admin.perpus-component', $data)->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'nama_perpustakaan' => 'required',
            'nama_pustakawan' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'website' => 'required|url',
            'no_telp' => 'required|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'keterangan' => 'required'
        ], [
            'nama_perpustakaan.required' => 'Nama perpustakaan wajib diisi.',
            'nama_pustakawan.required' => 'Nama pustakawan wajib diisi.',

            'alamat.required' => 'Alamat wajib diisi.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',

            'website.required' => 'Website wajib diisi.',
            'website.url' => 'Format URL tidak valid.',

            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'no_telp.string' => 'Nomor telepon harus berupa string.',
            'no_telp.max' => 'Nomor telepon maksimal 15 karakter.',
            'no_telp.regex' => 'Nomor telepon tidak valid.',
            
            'keterangan.required' => 'Keterangan wajib diisi.'
        ]);
        Perpustakaan::create([
            'nama_perpustakaan' => $this->nama_perpustakaan,
            'nama_pustakawan' => $this->nama_pustakawan,
            'alamat' => $this->alamat,
            'email' => $this->email,
            'website' => $this->website,
            'no_telp' => $this->no_telp,
            'keterangan' => $this->keterangan,
        ]);
        $this->reset();
        session()->flash('Success', 'Berhasil Disimpan!');
        return redirect()->route('perpus');
    }
    public function edit($id)
    {
        $perpustakaan = Perpustakaan::find($id);
        $this->nama_perpustakaan = $perpustakaan->nama_perpustakaan;
        $this->nama_pustakawan = $perpustakaan->nama_pustakawan;
        $this->alamat = $perpustakaan->alamat;
        $this->email = $perpustakaan->email;
        $this->website = $perpustakaan->website;
        $this->no_telp = $perpustakaan->no_telp;
        $this->keterangan = $perpustakaan->keterangan;
        $this->id = $perpustakaan->id;
    }
    public function update()
    {
        $perpustakaan = Perpustakaan::find($this->id);
        $perpustakaan->update([
            'nama_perpustakaan' => $this->nama_perpustakaan,
            'nama_pustakawan' => $this->nama_pustakawan,
            'alamat' => $this->alamat,
            'email' => $this->email,
            'website' => $this->website,
            'no_telp' => $this->no_telp,
            'keterangan' => $this->keterangan,
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('perpus');
    }
    public function confirm($id)
    {
        $this->id = $id;
    }
    public function destroy()
    {
        $perpustakaan = Perpustakaan::find($this->id);
        $perpustakaan->delete();
        $this->reset();
        session()->flash('success', 'Data Berhasil Dihapus!');
        return redirect()->route('perpus');
    }
}
