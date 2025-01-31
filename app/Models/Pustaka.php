<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pustaka extends Model
{
    use HasFactory;

    protected $table = 'pustakas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'kode_pustaka',
        'ddc_id',
        'format_id',
        'penerbit_id',
        'pengarang_id',
        'isbn',
        'judul_pustaka',
        'tahun_terbit',
        'keyword',
        'keterangan_fisik',
        'keterangan_tambahan',
        'abstraksi',
        'gambar',
        'harga_buku',
        'kondisi_buku',
        'rp',
        'jml_pinjam',
        'denda_terlambat',
        'denda_hilang'
    ];

    protected $casts = [
        'tahun_terbit' => 'integer',
        'harga_buku' => 'float',
        'jml_pinjam' => 'integer',
        'denda_terlambat' => 'float',
        'denda_hilang' => 'float',
    ];

    public function ddc()
    {
        return $this->belongsTo(Ddc::class, 'ddc_id');
    }

    public function format()
    {
        return $this->belongsTo(Format::class, 'format_id');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }

    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class, 'pengarang_id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'pustaka_id');
    }
}
