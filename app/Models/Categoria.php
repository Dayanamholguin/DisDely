<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $table = "categorias";

    public $timestamps = false;
    
    protected $fillable = [
        'nombre',
        'imagen',
        'estado',
    ];

    public static $rules = [
        'nombre' => 'required',
        'imagen' => 'required',
        'estado' => 'in:1,0'
    ];
}
