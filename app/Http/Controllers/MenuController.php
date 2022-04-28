<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Sabor;

class MenuController extends Controller
{
    public function productos()
    {
        $productos = Producto::all();
        return view('menu.productos', compact('productos'));
    }

    public function detalle($id)
    {
        $productos = Producto::find($id);
        $categoria = Producto::select('categorias.nombre')->join("categorias", "productos.idCategoria", "categorias.id")->value('nombre');
        $sabor = Producto::select('sabores.nombre')->join("sabores", "productos.idsabor", "sabores.id")->value('nombre');
        $genero = Producto::select('generos.nombre')->join("generos", "productos.idgenero", "generos.id")->value('nombre');
        $etapa = Producto::select('etapas.nombre')->join("etapas", "productos.idetapa", "etapas.id")->value('nombre');
        return view("menu.detalleProducto", compact("productos", "categoria", "sabor", "genero", "etapa"));
    }

    public function carrito()
    {
        return view('menu.carrito');
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
