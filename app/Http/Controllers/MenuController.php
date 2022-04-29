<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function galeria()
    {
        return view('menu.galeria');
    }
    public function contacto()
    {
        return view('menu.contacto');
    }
    public function quienes()
    {
        return view('menu.quienes');
    }
}