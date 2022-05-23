<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Sabor;

class MenuController extends Controller
{
    public function welcome()
    {
        $productos = Producto::select('*')
        ->orderByDesc('id')
        ->limit(3)
        ->where('id', '<>', 1)
        ->get();
        
        return view('layouts.menu', compact('productos'));
    }

    // public function detalle($id)
    // {
    //     $productos = Producto::find($id);
    //     $categoria = Producto::select('categorias.nombre')->join("categorias", "productos.idCategoria", "categorias.id")->value('nombre');
    //     $sabor = Producto::select('sabores.nombre')->join("sabores", "productos.idsabor", "sabores.id")->value('nombre');
    //     $etapa = Producto::select('etapas.nombre')->join("etapas", "productos.idetapa", "etapas.id")->value('nombre');
    //     return view("menu.detalleProducto", compact("productos", "categoria", "sabor", "etapa"));
    // }

    // public function carrito()
    // {
    //     return view('menu.carrito');
    // }

    // public function contacto()
    // {
    //     return view('menu.contacto');
    // }
    // public function quienes()
    // {
    //     return view('menu.quienes');
    // }
}
