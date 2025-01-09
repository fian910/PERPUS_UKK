<?php

namespace App\Livewire;

use App\Models\Rak;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RakComponent extends Component
{
    public $kode_rak, $rak, $keterangan, $id;
    public function render()
    {
        $layout['title'] = "Kelola Rak";
        $data['raks'] = Rak::all();
        return view('livewire.rak-component', $data)->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'kode_rak' => 'required|string|unique:raks,kode_rak|max:10',
            'rak' => 'required|string|unique:raks,rak|max:25',
            'keterangan' => 'nullable'
        ]);

        Rak::create([
            'kode_rak' => $this->kode_rak,
            'rak' => $this->rak,
            'keterangan' => $this->keterangan
        ]);
        $this->reset();
        session()->flash('Success', 'Berhasil Disimpan!');
        return redirect()->route('rak');
    }

    public function edit($id)
    {
        $rak = Rak::find($id);
        $this->kode_rak = $rak->kode_rak;
        $this->rak = $rak->rak;
        $this->keterangan = $rak->keterangan;
        $this->id = $rak->id;
    }

    public function update()
    {
        $rak = Rak::find($this->id);
        $rak->update([
            'kode_rak' => $this->kode_rak,
            'rak' => $this->rak,
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
        $rak = Rak::find($this->id);
        $rak->delete();
        session()->flash('success', 'Data Berhasil Dihapus!');
        $this->reset();
    }
}
