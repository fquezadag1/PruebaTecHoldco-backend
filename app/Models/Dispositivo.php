<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    use HasFactory;

    protected $table = 'dispositivos';

    protected $fillable = [
        'nom_dispositivo',
        'modelo_id',
        'bodega_id'
    ];

    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }

    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'bodega_id');
    }
}
