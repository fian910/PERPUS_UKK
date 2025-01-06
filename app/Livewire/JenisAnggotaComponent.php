<?php

namespace App\Livewire;

use App\Models\JenisAnggota;
use Livewire\Component;

class JenisAnggotaComponent extends Component
{
    public $id, $kode_jenis_anggota, $jenis_anggota, $max_pinjam, $keterangan;
    public function render()
    {
        $layout['title']="Kelola Jenis Anggota";
        $data['jenisanggota']= JenisAnggota::all();
        return view('livewire.jenis-anggota-component', $data)->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'kode_jenis_anggota' => 'required',
            'jenis_anggota' => 'required',
            'max_pinjam' => 'required',
            'keterangan' => 'required',
        ]);
        JenisAnggota::create([
            'kode_jenis_anggota' => $this->kode_jenis_anggota,
            'jenis_anggota' => $this->jenis_anggota,
            'max_pinjam' => $this->max_pinjam,
            'keterangan' => $this->keterangan,
        ]);
        session()->flash('Success', 'Berhasil Disimpan!');
        $this->reset();
    }

    public function edit($id)
    {
        $jenisanggota = JenisAnggota::find($id);
        $this->kode_jenis_anggota = $jenisanggota->kode_jenis_anggota;
        $this->jenis_anggota = $jenisanggota->jenis_anggota;
        $this->max_pinjam = $jenisanggota->max_pinjam;
        $this->keterangan = $jenisanggota->keterangan;
    }

    public function update()
    {
        $jenisanggota = JenisAnggota::find($this->id);
        $jenisanggota->update([
            'kode_jenis_anggota' => $this->kode_jenis_anggota,
            'jenis_anggota' => $this->jenis_anggota,
            'max_pinjam' => $this->max_pinjam,
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
        $jenisanggota= JenisAnggota::find($this->id);
        $jenisanggota->delete();
        session()->flash('success', 'Data Berhasil Dihapus!');
        $this->reset();
    }
}
