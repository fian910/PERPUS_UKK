<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Format extends Model
{
    use HasFactory;

    protected $table = 'formats';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'kode_format',
        'format',
        'keterangan'
    ];

    public function pustakas()
    {
        return $this->hasMany(Pustaka::class, 'format_id');
    }
}
