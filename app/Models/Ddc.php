<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ddc extends Model
{
    use HasFactory;

    protected $table='ddcs';
    protected $primaryKey='id';
    public $timestamps = false;
    
    protected $fillable=[
        'id',
        'rak_id',
        'kode_ddc',
        'ddc',
        'keterangan'
    ];  

    public function rak():BelongsTo 
    {
        return $this->belongsTo(Rak::class, 'rak_id');
    }

    public function pustakas()
    {
        return $this->hasMany(Pustaka::class, 'ddc_id');
    }
}
