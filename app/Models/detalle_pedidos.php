<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_pedidos extends Model
{
    public $table = "detalle_pedidos";

    public $timestamps = false;
    
    protected $fillable = [
        'idPedido',
        'idProducto',
        'numeroPersonas',
        'saborDeseado',
        'frase',
        'pisos',
        'descripcionProducto',
        'img',
    ];

    public static $rules = [
        // 'idPedido' => 'required|exists:pedidos,id',
        'idProducto' => 'required|exists:productos,id',
        'numeroPersonas' => 'required|numeric',
        'saborDeseado' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',
        // 'frase' => 'alpha',
        'pisos' => 'required|numeric',
        'descripcionProducto' => 'required',
        'img' => 'image'
    ];
}
