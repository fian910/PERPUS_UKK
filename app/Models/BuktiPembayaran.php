<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPembayaran extends Model
{
    protected $fillable = [
        'transaksi_id', 
        'jumlah_denda', 
        'bukti_pembayaran', 
        'status'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}