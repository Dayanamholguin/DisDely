<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sabor extends Model
{
    public $table = "sabores";

    public $timestamps = false;
    
    protected $fillable = [
        'nombre',
        'estado',
    ];

    public static $rules = [
        'nombre' => 'required|min:3',
        'estado' => 'in:1,0'
    ];
}
