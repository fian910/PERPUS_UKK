<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'anggotas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'jenis_anggota_id',
        'kode_anggota',
        'nama_anggota',
        'tempat',
        'tgl_lahir',
        'alamat',
        'no_telp',
        'email',
        'tgl_daftar',
        'masa_aktif',
        'fa',
        'keterangan',
        'foto',
        'username',
        'password'
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'anggota_id');
    }

    public function jenis_anggota()
    {
        return $this->belongsTo(JenisAnggota::class, 'anggota_id');
    }
}
