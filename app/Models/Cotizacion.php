<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cotizacion extends Model
{
    use Notifiable;
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
        'estado' => 'required|exists:estado_cotizaciones,id'
    ];
}
