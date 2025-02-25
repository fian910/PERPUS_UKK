<?php

namespace App\Livewire;

use App\Models\Ddc;
use App\Models\Format;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Pustaka;
use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class PustakaComponent extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $kode_pustaka, $ddc_id, $format_id, $penerbit_id, $pengarang_id, $isbn, $judul_pustaka, $tahun_terbit, $keyword, $keterangan_fisik, $keterangan_tambahan, $abstraksi, $gambar, $harga_buku, $kondisi_buku, $fp, $jml_pinjam, $denda_terlambat, $denda_hilang, $stock, $id, $cari;
    public function render()
    {
        $layout['title'] = "Kelola Pustaka";
        if ($this->cari) {
            $data['pustaka'] = Pustaka::where('kode_pustaka', 'like', '%' . $this->cari . '%')
                ->orwhere('isbn', 'like', '%' . $this->cari . '%')
                ->paginate(5);
        } else {
            $data['pustaka'] = Pustaka::paginate(5);
        }
        $data['ddc'] = Ddc::all();
        $data['format'] = Format::all();
        $data['penerbit'] = Penerbit::all();
        $data['pengarang'] = Pengarang::all();

        return view('livewire.admin.pustaka-component', $data)
            ->extends('components.layouts.app')
            ->section('content')
            ->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'ddc_id' => 'required|exists:ddcs,id',
            'format_id' => 'required|exists:formats,id',
            'penerbit_id' => 'required|exists:penerbits,id',
            'pengarang_id' => 'required|exists:pengarangs,id',
            'kode_pustaka' => 'required|unique:pustakas,kode_pustaka',
            'isbn' => 'required|string|unique:pustakas,isbn',
            'judul_pustaka' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4',
            'keyword' => 'required|string',
            'keterangan_fisik' => 'required|string',
            'keterangan_tambahan' => 'required|string',
            'abstraksi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'harga_buku' => 'required|numeric',
            'kondisi_buku' => 'required|string',
            'fp' => 'required|numeric',
            'denda_terlambat' => 'required|numeric',
            'denda_hilang' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ], [
            'ddc_id.required' => 'DDC wajib dipilih',
            'ddc_id.exists' => 'DDC tidak valid',

            'format_id.required' => 'Format wajib dipilih',
            'format_id.exists' => 'Format tidak valid',

            'penerbit_id.required' => 'Penerbit wajib dipilih',
            'penerbit_id.exists' => 'Penerbit tidak valid',

            'pengarang_id.required' => 'Pengarang wajib dipilih',
            'pengarang_id.exists' => 'Pengarang tidak valid',

            'kode_pustaka.required' => 'Kode pustaka wajib diisi',
            'kode_pustaka.unique' => 'Kode pustaka sudah digunakan',

            'isbn.required' => 'ISBN wajib diisi',
            'isbn.unique' => 'ISBN sudah digunakan',

            'judul_pustaka.required' => 'Judul pustaka wajib diisi',
            'judul_pustaka.max' => 'Judul pustaka maksimal 255 karakter',

            'tahun_terbit.required' => 'Tahun terbit wajib diisi',
            'tahun_terbit.digits' => 'Tahun terbit harus 4 digit angka',

            'keyword.required' => 'Kata kunci wajib diisi',

            'keterangan_fisik.required' => 'Keterangan fisik wajib diisi',

            'keterangan_tambahan.required' => 'Keterangan tambahan wajib diisi',

            'abstraksi.required' => 'Abstraksi wajib diisi',

            'gambar.required' => 'Gambar wajib diunggah',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',

            'harga_buku.required' => 'Harga buku wajib diisi',
            'harga_buku.numeric' => 'Harga buku harus berupa angka',

            'kondisi_buku.required' => 'Kondisi buku wajib diisi',

            'fp.required' => 'Jumlah denda harus diisi',
            'fp.numeric' => 'Jumlah denda harus berupa angka',

            'denda_terlambat.required' => 'Denda keterlambatan wajib diisi',

            'denda_terlambat.numeric' => 'Denda keterlambatan harus berupa angka',

            'denda_hilang.required' => 'Denda kehilangan wajib diisi',

            'denda_hilang.numeric' => 'Denda kehilangan harus berupa angka',

            'stock.required' => 'Stock buku wajib diisi',
            'stock.integer' => 'Stock harus berupa angka',
            'stock.min' => 'Stock tidak boleh kurang dari 0',
        ]);

        $namaFoto = $this->kode_pustaka . '_' . time() . '.' . $this->gambar->getClientOriginalExtension();
        $pathFoto = $this->gambar->storeAs('fotos', $namaFoto, 'public');

        Pustaka::create([
            'ddc_id' => $this->ddc_id,
            'format_id' => $this->format_id,
            'penerbit_id' => $this->penerbit_id,
            'pengarang_id' => $this->pengarang_id,
            'kode_pustaka' => $this->kode_pustaka,
            'isbn' => $this->isbn,
            'judul_pustaka' => $this->judul_pustaka,
            'tahun_terbit' => $this->tahun_terbit,
            'keyword' => $this->keyword,
            'keterangan_fisik' => $this->keterangan_fisik,
            'keterangan_tambahan' => $this->keterangan_tambahan,
            'abstraksi' => $this->abstraksi,
            'gambar' => $pathFoto,
            'harga_buku' => $this->harga_buku,
            'kondisi_buku' => $this->kondisi_buku,
            'fp' => $this->fp,
            'denda_terlambat' => $this->denda_terlambat,
            'denda_hilang' => $this->denda_hilang,
            'stock' => $this->stock,
        ]);
        $this->reset();
        session()->flash('Success', 'Berhasil Disimpan!');
        return redirect()->route('pustaka');
    }

    public function edit($id)
    {
        $pustaka = Pustaka::find($id);
        $this->id = $pustaka->id;
        $this->ddc_id = $pustaka->ddc_id;
        $this->format_id = $pustaka->format_id;
        $this->penerbit_id = $pustaka->penerbit_id;
        $this->pengarang_id = $pustaka->pengarang_id;
        $this->kode_pustaka = $pustaka->kode_pustaka;
        $this->isbn = $pustaka->isbn;
        $this->judul_pustaka = $pustaka->judul_pustaka;
        $this->tahun_terbit = $pustaka->tahun_terbit;
        $this->keyword = $pustaka->keyword;
        $this->keterangan_fisik = $pustaka->keterangan_fisik;
        $this->keterangan_tambahan = $pustaka->keterangan_tambahan;
        $this->abstraksi = $pustaka->abstraksi;
        $this->gambar = $pustaka->gambar;
        $this->harga_buku = $pustaka->harga_buku;
        $this->kondisi_buku = $pustaka->kondisi_buku;
        $this->fp = $pustaka->fp;
        $this->denda_terlambat = $pustaka->denda_terlambat;
        $this->denda_hilang = $pustaka->denda_hilang;
        $this->stock = $pustaka->stock;
    }

    public function update()
    {
        $this->validate([
            'ddc_id' => 'required|exists:ddcs,id',
            'format_id' => 'required|exists:formats,id',
            'penerbit_id' => 'required|exists:penerbits,id',
            'pengarang_id' => 'required|exists:pengarangs,id',
            'kode_pustaka' => 'required|unique:pustakas,kode_pustaka,' . $this->id,
            'isbn' => 'required|string|unique:pustakas,isbn,' . $this->id,
            'judul_pustaka' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4',
            'keyword' => 'required|string',
            'keterangan_fisik' => 'required|string',
            'keterangan_tambahan' => 'required|string',
            'abstraksi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga_buku' => 'required|numeric',
            'kondisi_buku' => 'required|string',
            'fp' => 'required|in:0,1',
            'denda_terlambat' => 'required|numeric',
            'denda_hilang' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        $pustaka = Pustaka::find($this->id);

        if (!$pustaka) {
            session()->flash('error', 'Pustaka tidak ditemukan!');
            return;
        }

        if ($this->gambar && !is_string($this->gambar)) {
            if ($pustaka->gambar) {
                Storage::disk('public')->delete($pustaka->gambar);
            }

            $namaFoto = $this->kode_pustaka . '_' . time() . '.' . $this->gambar->getClientOriginalExtension();
            $pathFoto = $this->gambar->storeAs('fotos', $namaFoto, 'public');
        } else {
            $pathFoto = $pustaka->gambar;
        }

        $pustaka->update([
            'ddc_id' => $this->ddc_id,
            'format_id' => $this->format_id,
            'penerbit_id' => $this->penerbit_id,
            'pengarang_id' => $this->pengarang_id,
            'kode_pustaka' => $this->kode_pustaka,
            'isbn' => $this->isbn,
            'judul_pustaka' => $this->judul_pustaka,
            'tahun_terbit' => $this->tahun_terbit,
            'keyword' => $this->keyword,
            'keterangan_fisik' => $this->keterangan_fisik,
            'keterangan_tambahan' => $this->keterangan_tambahan,
            'abstraksi' => $this->abstraksi,
            'gambar' => $pathFoto,
            'harga_buku' => $this->harga_buku,
            'kondisi_buku' => $this->kondisi_buku,
            'fp' => $this->fp,
            'denda_terlambat' => $this->denda_terlambat,
            'denda_hilang' => $this->denda_hilang,
            'stock' => $this->stock,
        ]);

        $this->reset();
        session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('pustaka');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $pustaka = Pustaka::find($this->id);
        $pustaka->delete();
        $this->reset();
        session()->flash('success', 'Data Berhasil Dihapus!');
        return redirect()->route('pustaka');
    }
}
