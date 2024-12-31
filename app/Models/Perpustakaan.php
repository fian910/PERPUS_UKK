<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perpustakaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'perpustakaans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_perpustakaan',
        'nama_pustakawan',
        'alamat',
        'email',
        'website',
        'no_telp',
        'keterangan'
    ];
}
