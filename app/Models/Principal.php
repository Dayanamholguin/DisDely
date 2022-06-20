<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    public $table = "principal";

    public $timestamps = false;
    
    protected $fillable = [
        'quienes',
        'productos',
        'ubicacion',
        'email',
        'celular',
        'celular2',
        'foto',
        'foto2',
        'instagram',
    ];

    public static $rules = [
        'quienes' => 'required',
        'productos'=>'required',
        'ubicacion'=>'required',
        'email'=>'required',
        'celular'=>'numeric',
        'celular2'=>'numeric',
        // 'foto'=>'required',
        // 'foto2'=>'required',
        'instagram'=>'required'
    ];
}
