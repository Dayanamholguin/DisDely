<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cotizacion;
use App\Models\detalle_cotizaciones;
use Flash;
// use Cart;

use App\Http\Controllers\File;

class CartController extends Controller
{
    public function carrito()
    {
        $carritoCollection = \Cart::getContent();
        // dd($carritoCollection);
        return view('carrito.carrito', compact("carritoCollection"));
    }
    public function ver($id)
    {
        $producto = \Cart::get($id);
        return $producto;
    }
    public function verImagen($id)
    {
        $producto = Producto::where('id', $id)->firstOrFail();
        $mi_imagen = public_path() . '/imagenes/' . $producto->img;
        // $imagen=storage_path("/imagenes/" . $producto->img);
        return response()->file($mi_imagen);
    }
    public function quitarProducto(Request $request)
    {
        $carritoCollection = \Cart::getContent();
        if (count($carritoCollection) > 1) {
            \Cart::remove($request->id);
        }else {
            Flash("Ojo, no puede quedar la cotización sin productos.")->warning()->important();
            return back();
        }
        Flash::success("Se removió correctamente el producto");
        // $carritoCollection = \Cart::getContent();
        // return view('carrito.carrito', compact("carritoCollection"));
        return back();
    }

    public function agregarCarrito(Request $request)
    {
        // $request->validate(reportes::$rules);
        $request->validate(detalle_cotizaciones::$rules);
        $producto = Producto::find($request->idProducto);
        if ($producto == null) {
            Flash::error("No se encontró el producto");
            return back();
        }
        if ($producto->nombre != $request->productoNombre) {
            Flash::error("El nombre del producto no coincide");
            return back();
        }
        $img = null;
        if ($request->img != null) {
            $img = $producto->nombre . '.' . time() . '.' . $request->img->extension();
            $request->img->move(public_path('imagenes'), $img);
        }
        $userId = auth()->user()->id;
        $userName = auth()->user()->nombre . " " . auth()->user()->apellido;
        $cotizacion = 0;
        $carritoCollection = \Cart::getContent();
        if (count($carritoCollection)<>0) {
            foreach ($carritoCollection as $value) {
                $cotizacion = $value->attributes->idCotizacion;
            }
        }
        // dd($producto->id);
        \Cart::add(array(
            'id' => $producto->id,
            'name' => $producto->nombre,
            'price' => 0,
            'quantity' => 1,
            'attributes' => array(
                'idCotizacion'=>$cotizacion==null?0:$cotizacion,
                'img' => $producto->img==null?$img:$producto->img,
                'saborDeseado' => $request->saborDeseado,
                'numeroPersonas' => $request->numeroPersonas,
                'frase' => $request->frase,
                'pisos' => $request->pisos,
                'descripcionProducto' => $request->descripcionProducto,
                'clienteId' => $userId,
                'cliente' => $userName,
                'imagen1' => $img,
            )
        ));
        // dd(\Cart::getContent());
        Flash::success("Se agregó correctamente el producto");
        $productos = Producto::all()->where('catalogo', 1)->where('id', '>', 1);
        return view('producto.catalogo', compact("productos"));
    }

    // public function actualizarCarrito(Request $request)
    // {
    //     if ($request->quantity < 0 || $request->quantity == 0) {
    //         Flash::error("No se puede poner números negativos");
    //         $carritoCollection = \Cart::getContent();
    //         return view('carrito.carrito', compact("carritoCollection"));
    //     }
        
    //     \Cart::update(
    //         $request->id,
    //         array(
    //             'quantity' => array(
    //                 'relative' => false,
    //                 'value' => $request->quantity
    //             ),
    //         )
    //     );
    //     Flash::success("Carrito actualizado");
    //     $carritoCollection = \Cart::getContent();
    //     return view('carrito.carrito', compact("carritoCollection"));
    // }

    public function actualizarCarrito(Request $request)
    {
        $producto = \Cart::get($request->id);
        $productoBD= Producto::find($request->id);
        // dd($productoBD?'existe':'no existe');
        if ($producto==null || $productoBD==null) {
            Flash("No se encontró el producto")->error();
            return back();
        }
        $campos = [
            'saborDeseado' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'],
            'numeroPersonas' => ['required', 'numeric'],
            'pisos' => ['required', 'numeric'],
            // 'frase' => ['string'],
            'descripcionProducto' => ['required', 'string'],
            'img' => ['image'],
        ];
        $this->validate($request, $campos);
        
        
        $img = $producto->attributes->imagen1;
        if ($request->img != null) {
            $img = $producto->name . '.' . time() . '.' . $request->img->extension();
            $request->img->move(public_path('imagenes'), $img);
        }
        
        $cotizacion = 0;
        $carritoCollection = \Cart::getContent();
        if (count($carritoCollection)<>0) {
            foreach ($carritoCollection as $value) {
                $cotizacion = $value->attributes->idCotizacion;
            }
        }
        
        $cotizacionBD = Cotizacion::find($cotizacion);
        // dd($cotizacionBD->idUser==$request->idUser?'son iguales':'no son los mismos');
        if ($cotizacionBD->idUser!=$request->idUser) {
            Flash("No es el mismo usuario que hizo la cotización")->error();
            return back();
        }
        $cotizacionUsuario = Cotizacion::select('users.nombre')->join("users", "users.id", "cotizaciones.idUser")->where("cotizaciones.id", $cotizacionBD->id)->value("nombre");
        // dd($request->imagenJs);
        \Cart::update(
            $request->id,
            array(
                'attributes' => array(
                    'idCotizacion'=>$cotizacion==null?0:$cotizacion,
                    'img' => $producto->attributes->img==null?$img:$producto->attributes->img,
                    'saborDeseado' => $request->saborDeseado,
                    'numeroPersonas' => $request->numeroPersonas,
                    'frase' => $request->frase,
                    'pisos' => $request->pisos,
                    'descripcionProducto' => $request->descripcionProducto,
                    'clienteId' => $cotizacionBD->idUser,
                    'cliente' => $cotizacionUsuario,
                    'imagen1' => $img,
                )
            )
        );
        Flash::success("Producto actualizado");
        return back();
    }

    public function limpiarCarrito()
    {
        \Cart::clear();
        Flash::success("Se limpió el carrito");
        $productos = Producto::all()->where('catalogo', 1)->where('id', '>', 1);
        return view('producto.catalogo', compact("productos"));
    }
}
