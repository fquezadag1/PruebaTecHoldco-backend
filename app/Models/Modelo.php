<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Modelo extends Model
{
    use HasFactory;

    protected $table = 'modelos';

    protected $fillable = [
        'nom_modelo',
        'marca_id'
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }
   
}
