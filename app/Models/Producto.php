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
        'img2',
        'img3',
        'numeroPersonas',
        'pisos',
        'catalogo',
        'estado',
    ];
//acá con las tablas
    public static $rules =[
        'idCategoria'=>'required|exists:categoria,id',
        'idSabor'=>'required|exists:sabor,id',
        'idGenero'=>'required|exists:generos,id',
        'idEtapa'=>'required|exists:etapas,id',
        'nombre' => 'required|min:3',
        'descripcion' => 'required|max:500',
        'img' => 'required',
        'numeroPersonas' => 'required|numeric',
        'pisos' => 'required|numeric',
        'catalogo' => 'required|in:1,0',
        'estado' => 'in:1,0'
    ];
}
