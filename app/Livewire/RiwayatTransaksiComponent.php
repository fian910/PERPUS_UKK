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

    public function calculateDenda($transaksi)
    {
        if ($transaksi->fp === '0' && 
            $transaksi->tgl_pengembalian && 
            Carbon::parse($transaksi->tgl_pengembalian) > Carbon::parse($transaksi->tgl_kembali)) {
            
            $keterlambatan = Carbon::parse($transaksi->tgl_pengembalian)->diffInDays(Carbon::parse($transaksi->tgl_kembali));
            
            return $keterlambatan * $transaksi->pustaka->denda_terlambat;
        }
        
        return 0;
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