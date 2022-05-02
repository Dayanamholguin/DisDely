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
        'fechaNacimiento',
        'idGenero',
        'foto',
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
        'celular' => ['required', 'string', 'max:25'],
        'celularAlternativo' => ['string', 'max:25'],
        'fechaNacimiento' => ['required'],
        'genero' => ['required', 'exists:generos,id'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];
}
