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
        return view('livewire.perpus-component', $data)->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'nama_perpustakaan' => 'required',
            'nama_pustakawan' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'no_telp' => 'required|numeric|digits_between:10,15',
            'keterangan' => 'required'
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
        session()->flash('Success', 'Berhasil Disimpan!');
        $this->reset();
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
        session()->flash('success', 'Berhasil Diubah!');
        $this->reset();
    }
    public function confirm($id)
    {
        $this->id = $id;
    }   
    public function destroy()
    {
        $perpustakaan = Perpustakaan::find($this->id);
        $perpustakaan->delete();
        session()->flash('success', 'Data Berhasil Dihapus!');
        $this->reset();
    }
}
