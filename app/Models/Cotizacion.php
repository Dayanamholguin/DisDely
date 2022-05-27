<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    public $table = "cotizaciones";
    
    protected $fillable = [
        'idUser',
        'fechaEntrega',
        'descripcionGeneral',
        'estado',
    ];

    public static $rules = [
        'idUser' => 'required|exists:users,id',
        'fechaEntrega' => 'required|date',
        'descripcionGeneral' => 'required',
        'estado' => 'in:1,0'
    ];
}
