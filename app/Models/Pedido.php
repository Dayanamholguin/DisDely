<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public $table = "pedidos";
    
    protected $fillable = [
        'idUser',
        'idCotizacion',
        'fechaEntrega',
        'descripcionGeneral',
        'estado',
        'precio',
    ];

    public static $rules = [
        'idUser' => 'required|exists:users,id',
        'idCotizacion' => 'required|exists:cotizaciones,id',
        'fechaEntrega' => 'required|date',
        'descripcionGeneral' => 'required',
        'estado' => 'required|exists:estado_pedidos,id',
        'precio' => 'required|numeric|regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/',
    ];
}
