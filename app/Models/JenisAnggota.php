<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisAnggota extends Model
{
    use HasFactory;

    protected $table = 'jenis_anggotas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'kode_jenis_anggota',
        'jns_anggota',
        'max_pinjam',
        'keterangan'
    ];

    public function anggotas()
    {
        return $this->hasMany(Anggota::class, 'jenis_anggota_id');
    }
}
