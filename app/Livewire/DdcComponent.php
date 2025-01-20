<?php

namespace App\Livewire;

use App\Models\Ddc;
use App\Models\Rak;
use Livewire\Component;

class DdcComponent extends Component
{
    public $rak_id, $kode_ddc, $ddc, $keterangan, $id;
    public function render()
    {
        $layout['title'] = "Kelola DDC";
        $data['ddcs'] = Ddc::all();
        $data['raks'] = Rak::all();
        return view('livewire.admin.ddc-component', $data)->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'rak_id' => 'required|exists:raks,id',
            'kode_ddc' => 'required|string|unique:ddcs,kode_ddc|max:10',
            'ddc' => 'required|string|unique:ddcs,ddc',
            'keterangan' => 'required|string',
        ], [
            'id_rak.required' => 'Rak wajib dipilih',
            'id_rak.exists' => 'Rak yang dipilih tidak valid',

            'kode_ddc.required' => 'Kode DDC wajib diisi',
            'kode_ddc.string' => 'Kode DDC harus berupa teks',
            'kode_ddc.unique' => 'Kode DDC sudah digunakan',
            'kode_ddc.max' => 'Kode DDC maksimal 10 karakter',

            'ddc.required' => 'DDC wajib diisi',
            'ddc.string' => 'DDC harus berupa teks',
            'ddc.unique' => 'DDC sudah digunakan',

            'keterangan.required' => 'Keterangan wajib diisi',
            'keterangan.string' => 'Keterangan harus berupa teks'
        ]);

        Ddc::create([
            'rak_id' => $this->rak_id,
            'kode_ddc' => $this->kode_ddc,
            'ddc' => $this->ddc,
            'keterangan' => $this->keterangan,
        ]);
        $this->reset();
        session()->flash('Success', 'Berhasil Disimpan!');
        return redirect()->route('ddc');
    }

    public function edit($id)
    {
        $ddc = Ddc::find($id);
        $this->id = $ddc->id;
        $this->rak_id = $ddc->rak_id;
        $this->kode_ddc = $ddc->kode_ddc;
        $this->ddc = $ddc->ddc;
        $this->keterangan = $ddc->keterangan;
    }

    public function update()
    {
        $ddc = Ddc::find($this->id);
        $ddc->update([
            'rak_id' => $this->rak_id,
            'kode_ddc' => $this->kode_ddc,
            'ddc' => $this->ddc,
            'keterangan' => $this->keterangan,
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('ddc');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $ddc = Ddc::find($this->id);
        $ddc->delete();
        $this->reset();
        session()->flash('success', 'Data Berhasil Dihapus!');
        return redirect()->route('ddc');
    }
}
