<?php

namespace App\Livewire;

use App\Models\JenisAnggota;
use Livewire\Component;

class JenisAnggotaComponent extends Component
{
    public $kode_jenis_anggota, $jns_anggota, $max_pinjam, $keterangan, $id;
    public function render()
    {
        $layout['title'] = "Kelola Jenis Anggota";
        $data['jenis_anggota'] = JenisAnggota::all();
        return view('livewire.jenis-anggota-component', $data)->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'kode_jenis_anggota' => 'required',
            'jns_anggota' => 'required',
            'max_pinjam' => 'required',
            'keterangan' => 'required',
        ]);
        JenisAnggota::create([
            'kode_jenis_anggota' => $this->kode_jenis_anggota,
            'jns_anggota' => $this->jns_anggota,
            'max_pinjam' => $this->max_pinjam,
            'keterangan' => $this->keterangan,
        ]);
        session()->flash('Success', 'Berhasil Disimpan!');
        $this->reset();
    }

    public function edit($id)
    {
        $jenis_anggota = JenisAnggota::find($id);
        $this->kode_jenis_anggota = $jenis_anggota->kode_jenis_anggota;
        $this->jns_anggota = $jenis_anggota->jns_anggota;
        $this->max_pinjam = $jenis_anggota->max_pinjam;
        $this->keterangan = $jenis_anggota->keterangan;
        $this->id = $jenis_anggota->id;

    }

    public function update()
    {
        $jenis_anggota = JenisAnggota::find($this->id);
        $jenis_anggota->update([
            'kode_jenis_anggota' => $this->kode_jenis_anggota,
            'jns_anggota' => $this->jns_anggota,
            'max_pinjam' => $this->max_pinjam,
            'keterangan' => $this->keterangan
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
        $jenis_anggota = JenisAnggota::find($this->id);
        $jenis_anggota->delete();
        session()->flash('success', 'Data Berhasil Dihapus!');
        $this->reset();
    }
}
