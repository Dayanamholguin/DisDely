<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $table = "users";
    
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'celular',
        'celularAlternativo',
        'estado',
        'idGenero',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static $rules = [
        'nombre' => ['required', 'string', 'max:255'],
        'apellido' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'celular' => ['required', 'numeric'],
        'celularAlternativo' => ['required','numeric'],
        'genero' => ['required', 'exists:generos,id'],
    ];
}
