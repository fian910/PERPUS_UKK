<?php

namespace App\Livewire;

use App\Models\Format;
use Livewire\Component;

class FormatComponent extends Component
{
    public $kode_format, $format, $keterangan, $id;
    public function render()
    {
        $layout['title'] = "Kelola Format";
        $data['formats'] = Format::all();
        return view('livewire.format-component', $data)->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'kode_format' => 'required|string|unique:formats,kode_format|max:10',
            'format' => 'required|string|unique:formats,format',
            'keterangan' => 'nullable'
        ], [
            'kode_format.required' => 'Kode format wajib diisi.',
            'kode_format.string' => 'Kode format harus berupa string.',
            'kode_format.unique' => 'Kode format sudah terdaftar.',
            'kode_format.max' => 'Kode format maksimal 10 karakter.',

            'format.required' => 'Format wajib diisi.',
            'format.string' => 'Format harus berupa string.',
            'format.unique' => 'Format sudah terdaftar.',
            
            'keterangan.string' => 'Keterangan harus berupa string.'
        ]);

        Format::create([
            'kode_format' => $this->kode_format,
            'format' => $this->format,
            'keterangan' => $this->keterangan
        ]);
        $this->reset();
        session()->flash('Success', 'Berhasil Disimpan!');
        return redirect()->route('format');
    }

    public function edit($id)
    {
        $format = Format::find($id);
        $this->kode_format = $format->kode_format;
        $this->format = $format->format;
        $this->keterangan = $format->keterangan;
        $this->id = $format->id;
    }

    public function update()
    {
        $format = Format::find($this->id);
        $format->update([
            'kode_format' => $this->kode_format,
            'format' => $this->format,
            'keterangan' => $this->keterangan,
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('format');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $format = Format::find($this->id);
        $format->delete();
        $this->reset();
        session()->flash('success', 'Data Berhasil Dihapus!');
        return redirect()->route('format');
    }
}
