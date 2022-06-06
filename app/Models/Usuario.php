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
        'foto',
        'idGenero',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static $rules = [
        'nombre' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'], 
        'apellido' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/'],
        'celular' => ['required', 'numeric'],
        'celularAlternativo' => ['required','numeric'],
        'genero' => ['required', 'exists:generos,id'],
    ];
}
