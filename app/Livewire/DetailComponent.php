<?php

namespace App\Livewire;

use App\Models\Pustaka;
use App\Models\Anggota;
use App\Models\Transaksi;
use Livewire\Component;

class DetailComponent extends Component
{
    public $pustaka_id, $anggota_id, $tgl_pengembalian, $fp = 0, $sb = 0, $keterangan;

    public function mount($id)
    {
        $this->pustaka_id = $id;

        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $anggota = $user->anggota;

        if (!$anggota) {
            session()->flash('error', 'Anda perlu melengkapi data anggota terlebih dahulu.');
            return redirect()->route('user');
        }

        $this->anggota_id = $anggota->id;
    }

    public function render()
    {
        $layout['title'] = "Detail Buku";

        $data['pustaka'] = Pustaka::with(['ddc', 'format', 'penerbit', 'pengarang'])
            ->findOrFail($this->pustaka_id);
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
            'tgl_pengembalian' => 'nullable|date|after_or_equal:today',
            'fp' => 'nullable|in:0,1',
            'sb' => 'nullable|in:0,1,2',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Check stock availability
        $pustaka = Pustaka::find($this->pustaka_id);
        if ($pustaka->stock <= 0) {
            session()->flash('error', 'Stok buku tidak mencukupi!');
            return;
        }

        // Decrease stock and increase borrowed count
        $pustaka->stock -= 1;
        $pustaka->jml_pinjam += 1;
        $pustaka->save();

        // Create transaction with fp as string
        Transaksi::create([
            'pustaka_id' => $this->pustaka_id,
            'anggota_id' => $this->anggota_id,
            'tgl_pinjam' => now(),
            'tgl_kembali' => now()->addDays(7),
            'tgl_pengembalian' => $this->tgl_pengembalian,
            'fp' => (string)$this->fp,
            'sb' => (string)$this->sb,
            'keterangan' => $this->keterangan,
        ]);

        session()->flash('success', 'Peminjaman berhasil dilakukan!');
        $this->reset();
        return redirect()->route('user');
    }
}
