<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_cotizaciones extends Model
{
    public $table = "detalle_cotizaciones";

    public $timestamps = false;
    
    protected $fillable = [
        'idCotizacion',
        'idProducto',
        'numeroPersonas',
        'saborDeseado',
        'frase',
        'pisos',
        'descripcionProducto',
        'img',
    ];

    public static $rules = [
        // 'idCotizacion' => 'required|exists:cotizaciones,id',
        'idProducto' => 'required|exists:productos,id',
        'numeroPersonas' => 'required|numeric',
        'saborDeseado' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',
        // 'frase' => 'alpha',
        'pisos' => 'required|numeric',
        'descripcionProducto' => 'required',
        'img' => 'image'
    ];
}
