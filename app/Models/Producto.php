<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $table = "productos";

    protected $fillable = [
        'idCategoria',
        'idSabor',
        'idGenero',
        'idEtapa',
        'nombre',
        'descripcion',
        'img',
        'numeroPersonas',
        'pisos',
        'catalogo',
        'estado',
    ];
//acá con las tablas
    public static $rules = [
        'IdCategoria'=>'required|exists:categorias,id',
        'IdSabor'=>'required|exists:sabores,id',
        'IdGenero'=>'required|exists:generos,id',
        'IdEtapa'=>'required|exists:etapas,id',
        'nombre' => 'required|min:3',
        'descripcion' => 'required|max:500',
        'imagen' => 'required',
        'numeroPersonas' => 'required|numeric',
        'pisos' => 'required|numeric',
        'catalogo' => 'required|in:1,0',
    ];
}
