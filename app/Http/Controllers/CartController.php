<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Flash;
// use Cart;

class CartController extends Controller
{
    public function carrito()  {
        $carritoCollection = \Cart::getContent();
        return view('carrito.carrito', compact("carritoCollection"));
    }
    public function quitarProducto(Request $request){
        \Cart::remove($request->id);
        Flash::success("Se removió correctamente el producto del carrito");
        $carritoCollection = \Cart::getContent();
        return view('carrito.carrito', compact("carritoCollection"));
    }

    public function agregarCarrito(Request $request){
        $producto = Producto::find($request->id);
        if ($producto==null) {
            Flash::error("No se encontró el producto");
            return back();
        }
        if ($producto->nombre!=$request->productoNombre) {
            Flash::error("El nombre del producto no coincide");
            return back();
        }
        $userId = auth()->user()->id;
        $userName = auth()->user()->nombre ." ". auth()->user()->apellido;
        \Cart::add(array(
            'id' => $producto->id,
            'name' => $producto->nombre,
            'price' => 0,
            'quantity' => 1,
            'attributes' => array(
                'img' => $producto->img,
                'saborDeseado' => $request->saborDeseado,
                'numeroPersonas' => $request->numeroPersonas,
                'frase' => $request->frase,
                'pisos' => $request->pisos,
                'descripcionProducto' => $request->descripcionProducto,
                'tiempo'=> now(),
                'clienteId'=>$userId,
                'cliente'=>$userName
            )
        ));
        Flash::success("Se agregó correctamente el producto al carrito");
        $productos = Producto::all()->where('catalogo', 1)->where('id','>',1);
        return view('producto.catalogo', compact("productos"));
    }

    public function actualizarCarrito(Request $request){
        if ($request->quantity<0 || $request->quantity==0) {
            Flash::error("No se puede poner números negativosno diferente de cero");
            $carritoCollection = \Cart::getContent();
            return view('carrito.carrito', compact("carritoCollection"));
        }
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));
        Flash::success("Carrito actualizado");
        $carritoCollection = \Cart::getContent();
        return view('carrito.carrito', compact("carritoCollection"));
       
    }

    public function limpiarCarrito(){
        \Cart::clear();
        Flash::success("Se limpió el carrito");
        $productos = Producto::all()->where('catalogo', 1)->where('id','>',1);
        return view('producto.catalogo', compact("productos"));
    }

 

}
