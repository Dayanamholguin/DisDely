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
    public static $rules =[
        'categoria'=>'required|exists:categorias,id',
        'sabor'=>'required|exists:sabores,id',
        'genero'=>'required|exists:generos,id',
        'etapa'=>'required|exists:etapas,id',
        'nombre' => 'required|min:3',
        'descripcion' => 'required|max:500',
        'imagen' => 'required',
        'numeroPersonas' => 'required|numeric',
        'pisos' => 'required|numeric',
        'catalogo' => 'required|in:1,0',
    ];
}
