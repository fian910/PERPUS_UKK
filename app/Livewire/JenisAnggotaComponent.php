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
            'kode_jenis_anggota' => 'required|max:10',
            'jns_anggota' => 'required',
            'max_pinjam' => 'required',
            'keterangan' => 'required',
        ], [
            'kode_jenis_anggota.required' => 'Kode jenis anggota wajib diisi.',
            'kode_jenis_anggota.max' => 'Kode jenis anggota maksimal 10 karakter',
            'jns_anggota.required' => 'Jenis anggota wajib diisi.',
            'max_pinjam.required' => 'Jumlah maksimum pinjam wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.'
        ]);
        JenisAnggota::create([
            'kode_jenis_anggota' => $this->kode_jenis_anggota,
            'jns_anggota' => $this->jns_anggota,
            'max_pinjam' => $this->max_pinjam,
            'keterangan' => $this->keterangan,
        ]);
        $this->reset();
        session()->flash('Success', 'Berhasil Disimpan!');
        return redirect()->route('jenis_anggota');
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
        $this->reset();
        session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('jenis_anggota');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $jenis_anggota = JenisAnggota::find($this->id);
        $jenis_anggota->delete();
        $this->reset();
        session()->flash('success', 'Data Berhasil Dihapus!');
        return redirect()->route('jenis_anggota');
    }
}
