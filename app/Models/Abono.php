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
    ];

    public static $rules = [
        'idPedido' => 'required|exists:pedidos,id',
        'precioPagar' => 'required',
        'img' => 'image'
    ];
}
