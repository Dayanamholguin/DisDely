<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    public $table = "abonos";
    
    protected $fillable = [
        'idPedido',
        'precioPagar',
        'img',
        'justificacion',
        'estado',
    ];

    public static $rules = [
        'idPedido' => 'required|exists:pedidos,id',
        'precioPagar' => 'required',
        'img' => 'image',
        'justificacion' => 'min:5|max:500',
        // 'estado' => 'required|exists:estado_abonos,id',
    ];
}
