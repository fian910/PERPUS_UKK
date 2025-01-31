<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Rak extends Model
{
    use HasFactory;

    protected $table = 'raks';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'kode_rak',
        'rak',
        'keterangan'
    ];

    public function ddcs()
    {
        return $this->hasMany(Ddc::class, 'rak_id');
    }
}
