<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class RiwayatTransaksiComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $showAlert = false;
    public $alertMessage = '';
    public $alertType = 'success';
    public $bookStatus = [];

    public function calculateDenda($transaksi)
    {
        $totalDenda = 0;

        // Calculate late return fine
        if (
            $transaksi->fp === '0' &&
            $transaksi->tgl_pengembalian &&
            Carbon::parse($transaksi->tgl_pengembalian) > Carbon::parse($transaksi->tgl_kembali)
        ) {
            $keterlambatan = Carbon::parse($transaksi->tgl_pengembalian)->diffInDays(Carbon::parse($transaksi->tgl_kembali));
            $totalDenda += $keterlambatan * $transaksi->pustaka->denda_terlambat;
        }

        // Calculate condition-based fine
        if ($transaksi->sb === '2') { // Book is lost
            $totalDenda += $transaksi->pustaka->denda_hilang;
        } elseif ($transaksi->sb === '1') { // Book is damaged
            $totalDenda += $transaksi->pustaka->denda_hilang / 4;
        }

        return $totalDenda;
    }

    public function getPaymentInstructions()
    {
        return [
            'title' => 'Cara Pembayaran Denda:',
            'steps' => [
                'Temui petugas perpustakaan di bagian administrasi',
                'Sebutkan nomor anggota Anda',
                'Tunjukkan riwayat transaksi yang memiliki denda',
                'Lakukan pembayaran sesuai jumlah denda yang tertera',
                'Tunggu petugas mengkonfirmasi pembayaran Anda'
            ]
        ];
    }

    public function requestStatusChange($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            $this->showAlert = true;
            $this->alertMessage = 'Transaksi tidak ditemukan!';
            $this->alertType = 'danger';
            return;
        }

        if ($transaksi->fp === '1') {
            $this->showAlert = true;
            $this->alertMessage = 'Transaksi sudah dikembalikan!';
            $this->alertType = 'warning';
            return;
        }

        // Update tanggal pengembalian to current date dan status pengajuan
        $transaksi->tgl_pengembalian = date('Y-m-d');
        $transaksi->pengajuan_kembali = true;
        $transaksi->save();

        // Calculate denda
        $denda = $this->calculateDenda($transaksi);

        // Show warning if there's any denda
        if ($denda > 0) {
            $this->showAlert = true;
            $this->alertMessage = 'Anda memiliki denda sebesar Rp. ' . number_format($denda, 0, ',', '.') . '. Silahkan melakukan pembayaran di administrasi perpustakaan terlebih dahulu sebelum mengembalikan buku.';
            $this->alertType = 'warning';
            return;
        }

        $this->showAlert = true;
        $this->alertMessage = 'Permintaan perubahan status telah dikirim ke admin!';
        $this->alertType = 'success';
    }

    public function closeAlert()
    {
        $this->showAlert = false;
        $this->alertMessage = '';
        $this->alertType = 'success';
    }

    public function updateBookStatus($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'sb' => $this->bookStatus[$id]
        ]);

        $this->showAlert = true;
        $this->alertMessage = 'Status buku berhasil diperbarui!';
        $this->alertType = 'success';
    }


    public function render()
    {
        $layout['title'] = "Riwayat Transaksi";
        $data['transaksi'] = Transaksi::with(['pustaka', 'anggota'])
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->through(function ($transaksi) {
                $transaksi->denda = $this->calculateDenda($transaksi);
                return $transaksi;
            });

        return view('livewire.user.riwayat-transaksi-component', $data)
            ->extends('components.layouts.user')
            ->section('content')
            ->layoutData($layout);
    }
}
