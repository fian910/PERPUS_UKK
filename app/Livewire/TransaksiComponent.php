<?php

namespace App\Livewire;

use App\Models\Anggota;
use App\Models\Pustaka;
use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class TransaksiComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $pustaka_id, $anggota_id, $tgl_pinjam, $tgl_kembali, $tgl_pengembalian, $fp, $keterangan, $id, $cari;
    public function render()
    {
        $layout['title'] = "Kelola Transaksi";
        $data['transaksi'] = Transaksi::paginate(5);
        $data['pustaka'] = Pustaka::all();
        $data['anggota'] = Anggota::all();
        return view('livewire.admin.transaksi-component', $data)
            ->extends('components.layouts.app')
            ->section('content')
            ->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'pustaka_id' => 'required|exists:pustakas,id',
            'anggota_id' => 'required|exists:anggotas,id',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
            'tgl_pengembalian' => 'required|date|after_or_equal:tgl_pinjam',
            'fp' => 'required|numeric',
            'keterangan' => 'required|string|max:255',
        ], [
            'pustaka_id.required' => 'Pustaka harus dipilih',
            'pustaka_id.exists' => 'Pustaka tidak ditemukan',

            'anggota_id.required' => 'Anggota harus dipilih',
            'anggota_id.exists' => 'Anggota tidak ditemukan',

            'tgl_pinjam.required' => 'Tanggal pinjam harus diisi',
            'tgl_pinjam.date' => 'Format tanggal pinjam tidak valid',

            'tgl_kembali.required' => 'Tanggal kembali harus diisi',
            'tgl_kembali.date' => 'Format tanggal kembali tidak valid',
            'tgl_kembali.after' => 'Tanggal kembali harus setelah tanggal pinjam',

            'tgl_pengembalian.required' => 'Tanggal pengembalian harus diisi',
            'tgl_pengembalian.date' => 'Format tanggal pengembalian tidak valid',
            'tgl_pengembalian.after_or_equal' => 'Tanggal pengembalian harus sama dengan atau setelah tanggal pinjam',

            'fp.required' => 'Jumlah denda harus diisi',
            'fp.numeric' => 'Jumlah denda harus berupa angka',

            'keterangan.required' => 'Keterangan harus diisi',
            'keterangan.string' => 'Keterangan harus berupa teks',
            'keterangan.max' => 'Keterangan maksimal 255 karakter'
        ]);

        Transaksi::create([
            'pustaka_id' => $this->pustaka_id,
            'anggota_id' => $this->anggota_id,
            'tgl_pinjam' => $this->tgl_pinjam,
            'tgl_kembali' => $this->tgl_kembali,
            'tgl_pengembalian' => $this->tgl_pengembalian,
            'fp' => $this->fp,
            'keterangan' => $this->keterangan,
        ]);
        $this->reset();
        session()->flash('Success', 'Berhasil Disimpan!');
        return redirect()->route('transaksi');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::find($id);
        $this->pustaka_id = $transaksi->pustaka_id;
        $this->anggota_id = $transaksi->anggota_id;
        $this->tgl_pinjam = $transaksi->tgl_pinjam;
        $this->tgl_kembali = $transaksi->tgl_kembali;
        $this->tgl_pengembalian = $transaksi->tgl_pengembalian;
        $this->fp = $transaksi->fp;
        $this->keterangan = $transaksi->keterangan;
        $this->id = $transaksi->id;
    }

    public function update()
    {
        $transaksi = Transaksi::find($this->id);
        $transaksi->update([
            'pustaka_id' => $this->pustaka_id,
            'anggota_id' => $this->anggota_id,
            'tgl_pinjam' => $this->tgl_pinjam,
            'tgl_kembali' => $this->tgl_kembali,
            'tgl_pengembalian' => $this->tgl_pengembalian,
            'fp' => $this->fp,
            'keterangan' => $this->keterangan,
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('transaksi');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $transaksi = Transaksi::find($this->id);
        $transaksi->delete();
        $this->reset();
        session()->flash('success', 'Data Berhasil Dihapus!');
        return redirect()->route('transaksi');
    }
}
