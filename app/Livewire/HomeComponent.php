<?php

namespace App\Livewire;

use App\Models\Anggota;
use App\Models\Pengarang;
use App\Models\Pustaka;
use App\Models\Transaksi;
use Livewire\Component;

class HomeComponent extends Component
{
    public $totalAnggota;
    public $totalPustaka;
    public $totalTransaksi;
    public $totalPengarang;
    public $chartDataAnggota = [];
    public $persentaseKenaikanAnggota = 0;
    public function render()
    {
        $x['title'] = "Perpustakaan";
        return view('livewire.admin.home-component')->layoutData($x);
    }
    public function mount()
    {
        $this->totalAnggota = Anggota::count();
        $this->totalPustaka = Pustaka::count();
        $this->totalTransaksi = Transaksi::count();
        $this->totalPengarang = Pengarang::count();

        $anggotaPerBulan = Anggota::selectRaw('MONTH(tgl_daftar) as bulan, COUNT(*) as total')
            ->whereYear('tgl_daftar', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Siapkan data untuk chart
        $labels = [];
        $values = [];
        $namaBulan = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ags',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des'
        ];

        // Inisialisasi semua bulan dengan 0
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $namaBulan[$i];
            $values[] = 0;
        }

        // Isi data aktual
        foreach ($anggotaPerBulan as $data) {
            $values[$data->bulan - 1] = $data->total;
        }

        // Hitung persentase kenaikan
        $totalAnggotaTahunIni = array_sum($values);
        $totalAnggotaTahunLalu = Anggota::whereYear('tgl_daftar', now()->year - 1)->count();

        $this->persentaseKenaikanAnggota = $totalAnggotaTahunLalu > 0
            ? round(($totalAnggotaTahunIni - $totalAnggotaTahunLalu) / $totalAnggotaTahunLalu * 100, 2)
            : 0;

        $this->chartDataAnggota = [
            'labels' => $labels,
            'values' => $values
        ];
    }
}
