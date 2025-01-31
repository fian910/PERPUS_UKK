<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengarang extends Model
{
    use HasFactory;

    protected $table = 'pengarangs';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'kode_pengarang',
        'gelar_depan',
        'nama_pengarang',
        'gelar_belakang',
        'no_telp',
        'email',
        'website',
        'biografi',
        'keterangan'
    ];

    public function pustakas()
    {
        return $this->hasMany(Pustaka::class, 'pengarang_id');
    }
}
