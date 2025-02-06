<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'pustaka_id',
        'anggota_id',
        'tgl_pinjam',
        'tgl_kembali',
        'tgl_pengembalian',
        'fp',
        'keterangan'
    ];


    public function pustaka()
    {
        return $this->belongsTo(Pustaka::class, 'pustaka_id');
    }

    public function buktiPembayaran()
    {
        return $this->hasOne(BuktiPembayaran::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}
