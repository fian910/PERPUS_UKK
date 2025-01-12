<?php

namespace App\Livewire;

use App\Models\Penerbit;
use Livewire\Component;

class PenerbitComponent extends Component
{
    public $kode_penerbit, $nama_penerbit, $alamat_penerbit, $no_telp, $email, $fax, $website, $kontak, $id;
    public function render()
    {
        $layout['title'] = "Kelola Penerbit";
        $data['penerbit'] = Penerbit::all();
        return view('livewire.penerbit-component', $data)->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'kode_penerbit' => 'required|string|unique:penerbits,kode_penerbit|max:10',
            'nama_penerbit' => 'required|string|unique:penerbits,nama_penerbit',
            'alamat_penerbit' => 'required|string',
            'no_telp' => 'required|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'required|email',
            'fax' => 'required|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'website' => 'required|url',
            'kontak' => 'required|string'
        ], [
            'kode_penerbit.required' => 'Kode penerbit wajib diisi.',
            'kode_penerbit.string' => 'Kode penerbit harus berupa string.',
            'kode_penerbit.unique' => 'Kode penerbit sudah terdaftar.',
            'kode_penerbit.max' => 'Kode penerbit maksimal 10 karakter.',

            'nama_penerbit.required' => 'Nama penerbit wajib diisi.',
            'nama_penerbit.string' => 'Nama penerbit harus berupa string.',
            'nama_penerbit.unique' => 'Nama penerbit sudah terdaftar.',

            'alamat_penerbit.required' => 'Alamat Penerbit wajib diisi.',
            'alamat_penerbit.string' => 'Alamat Penerbit harus berupa string.',

            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'no_telp.string' => 'Nomor telepon harus berupa string.',
            'no_telp.max' => 'Nomor telepon maksimal 15 karakter.',
            'no_telp.regex' => 'Nomor telepon tidak valid.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',

            'fax.required' => 'Fax wajib diisi.',
            'fax.string' => 'Fax harus berupa string.',
            'fax.max' => 'Fax maksimal 15 karakter.',
            'fax.regex' => 'Fax tidak valid.',

            'website.required' => 'Website wajib diisi.',
            'website.url' => 'Format URL tidak valid.',
            
            'kontak.required' => 'Kontak wajib diisi.',
            'kontak.string' => 'Kontak harus berupa string.'
        ]);
        Penerbit::create([
            'kode_penerbit' => $this->kode_penerbit,
            'nama_penerbit' => $this->nama_penerbit,
            'alamat_penerbit' => $this->alamat_penerbit,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
            'fax' => $this->fax,
            'website' => $this->website,
            'kontak' => $this->kontak,
        ]);
        $this->reset();
        session()->flash('Success', 'Berhasil Disimpan!');
        return redirect()->route('penerbit');
    }

    public function edit($id)
    {
        $penerbit = Penerbit::find($id);
        $this->kode_penerbit = $penerbit->kode_penerbit;
        $this->nama_penerbit = $penerbit->nama_penerbit;
        $this->alamat_penerbit = $penerbit->alamat_penerbit;
        $this->no_telp = $penerbit->no_telp;
        $this->email = $penerbit->email;
        $this->fax = $penerbit->fax;
        $this->website = $penerbit->website;
        $this->kontak = $penerbit->kontak;
        $this->id = $penerbit->id;
    }

    public function update()
    {
        $penerbit = Penerbit::find($this->id);
        $penerbit->update([
            'kode_penerbit' => $this->kode_penerbit,
            'nama_penerbit' => $this->nama_penerbit,
            'alamat_penerbit' => $this->alamat_penerbit,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
            'fax' => $this->fax,
            'website' => $this->website,
            'kontak' => $this->kontak,
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('penerbit');
    }
    public function confirm($id)
    {
        $this->id = $id;
    }
    public function destroy()
    {
        $penerbit = Penerbit::find($this->id);
        $penerbit->delete();
        $this->reset();
        session()->flash('success', 'Data Berhasil Dihapus!');
        return redirect()->route('penerbit');
    }
}
