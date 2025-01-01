<?php

namespace App\Livewire;

use App\Models\Perpustakaan;
use Livewire\Component;

class PerpusComponent extends Component
{
    public $nama_perpustakaan, $nama_pustakawan, $alamat, $email, $website, $no_telp, $keterangan;
    public function render()
    {
        $layout['title'] = "Kelola Perpustakaan";
        $data['perpus'] = Perpustakaan::all();
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
    }
}
