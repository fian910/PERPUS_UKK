<?php

namespace App\Livewire;

use App\Models\Pustaka;
use App\Models\Anggota;
use App\Models\Transaksi;
use Livewire\Component;

class DetailComponent extends Component
{
    public $pustakaId;
    public $anggota_id;
    public $tgl_pengembalian;
    public $fp;
    public $keterangan;
    
    public function mount($id)
    {
        $this->pustakaId = $id;
    }

    public function render()
    {
        $layout['title'] = "Detail Buku";
        
        $data['pustaka'] = Pustaka::with(['ddc', 'format', 'penerbit', 'pengarang'])
            ->findOrFail($this->pustakaId);
        $data['anggota'] = Anggota::all();

        return view('livewire.user.detail-component', $data)
            ->extends('components.layouts.user')
            ->section('content')
            ->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'tgl_pengembalian' => 'required|date|after_or_equal:today',
            'fp' => 'required|numeric',
            'keterangan' => 'required|string|max:255',
        ]);

        // Cek stok buku
        $pustaka = Pustaka::find($this->pustakaId);
        if ($pustaka->stock <= 0) {
            session()->flash('error', 'Stok buku tidak mencukupi!');
            return;
        }

        // Kurangi stok buku
        $pustaka->stock -= 1;
        $pustaka->jml_pinjam += 1;
        $pustaka->save();

        // Set tanggal pinjam dan kembali
        $tgl_pinjam = date('Y-m-d');
        $tgl_kembali = date('Y-m-d', strtotime($tgl_pinjam . '+7 days'));

        // Buat transaksi
        Transaksi::create([
            'pustaka_id' => $this->pustakaId,
            'anggota_id' => $this->anggota_id,
            'tgl_pinjam' => $tgl_pinjam,
            'tgl_kembali' => $tgl_kembali,
            'tgl_pengembalian' => $this->tgl_pengembalian,
            'fp' => $this->fp,
            'keterangan' => $this->keterangan,
        ]);

        // Reset form dan tampilkan pesan sukses
        $this->reset(['anggota_id', 'tgl_pengembalian', 'fp', 'keterangan']);
        session()->flash('success', 'Peminjaman berhasil disimpan!');
        
        // Redirect ke halaman user
        return redirect()->route('user');
    }
}