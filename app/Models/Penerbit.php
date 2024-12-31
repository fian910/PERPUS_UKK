<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penerbit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penerbits';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'kode_penerbit',
        'nama_penerbit',
        'alamat_penerbit',
        'no_telp',
        'email',
        'fax',
        'website',
        'kontak'
    ];

    public function pustakas()
    {
        return $this->hasMany(Pustaka::class, 'penerbit_id');
    }
}
