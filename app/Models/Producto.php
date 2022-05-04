<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'linea', 
        'intercambio',
        'catalogo', 
        'modelo', 
        'serie', 
        'color', 
        'ubicacion',
        'costo', 
        'estatus', 
        'observaciones', 
        'apartado'
    ];
}
