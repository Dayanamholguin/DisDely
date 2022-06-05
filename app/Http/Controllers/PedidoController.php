<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\Models\Producto;
use App\Models\detalle_cotizaciones;
use App\Models\detalle_pedidos;
use App\Models\Pedido;
use App\Models\cotizacion;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use DataTables;
use Flash;
use Cart;
use Carbon\Carbon;
use Illuminate\Support\ProcessUtils;
use Laracasts\Flash\Flash as FlashFlash;

class PedidoController extends Controller
{
    public function index()
    {
        return view('pedido.index');
    }
    public function listar(Request $request)
    {
        Date::setLocale('es');
        $pedido = Pedido::select("pedidos.*", "pedidos.estado as idEstado", "users.nombre as usuario", "estado_pedidos.nombre as estado")
            ->join("users", "users.id", "pedidos.idUser")
            ->join("estado_pedidos", "estado_pedidos.id", "pedidos.estado")
            ->get();

        return DataTables::of($pedido)
            ->editColumn('estado', function ($pedido) {
                if ($pedido->idEstado == 1) {
                    return '<p class="badge badge-secondary p-2">' . $pedido->estado . '</p>';
                } elseif ($pedido->idEstado == 2) {
                    return '<p class="badge badge-warning text-white p-2">' . $pedido->estado . '</p>';
                } elseif ($pedido->idEstado == 3) {
                    return '<p class="badge badge-danger p-2">' . $pedido->estado . '</p>';
                } elseif ($pedido->idEstado == 4) {
                    return '<p class="badge badge-success p-2">' . $pedido->estado . '</p>';
                }
            })
            ->editColumn('fechaEntrega', function ($pedido) {
                return ucwords(Date::create($pedido->fechaEntrega)->format('l, j F Y'));
            })
            ->editColumn('acciones', function ($pedido) {
                $acciones = '<a class="btn btn-info btn-sm" href="/pedido/editar/' . $pedido->id . '" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i> Editar</a> ';
                $acciones .= '<a class="btn btn-secondary btn-sm" href="/pedido/ver/' . $pedido->id . '" data-toggle="tooltip" data-placement="top"><i class="fas fa-info-circle"></i> Ver</a> ';
                return $acciones;
            })
            ->rawColumns(['acciones', 'estado'])
            ->make(true);
    }
    public function carrito($id)
    {
        $userId = Usuario::find($id);
        if ($userId == null) {
            Flash("No se encontró el cliente")->error()->warning();
            $carritoCollection = \Cart::getContent();
            return view('pedido.requisitos', compact("carritoCollection"));
        }
        if ($userId->id == 1) {
            $userName = Usuario::select('nombre')->where('id', $userId->id)->value('nombre');
        } else {
            $userName = $userId->nombre . " " . $userId->apellido;
        }
        $userId = $userId->id;
        $carritoCollection = \Cart::getContent();
        return view('pedido.carrito', compact("carritoCollection", "userId", "userName"));
    }
    public function requisitos()
    {
        $carritoCollection = \Cart::getContent();
        return view('pedido.requisitos', compact("carritoCollection"));
    }
    public function buscarUsuarios()
    {
        $Cliente = Usuario::select("*")->where("users.id", ">", 2)->where("estado", 1)->get();
        return $Cliente;
    }
    public function productosPedidos($id)
    {
        $cliente = Usuario::find($id);
        if ($cliente == null) {
            Flash("No se encontró el cliente")->error()->warning();
            $carritoCollection = \Cart::getContent();
            return view('pedido.requisitos', compact("carritoCollection"));
        }
        $productos = Producto::all()->where('catalogo', 1)->where('id', '>', 1);
        return view('pedido.productos', compact("productos", "cliente"));
    }
    public function crear(Request $request)
    {

        $campos = [
            // 'cliente' => ['in:1,2'],
            'producto' => ['in:1,2'],
        ];
        $this->validate($request, $campos);

        if ($request->cliente == 1) {
            $cliente = Usuario::find($request->cliente);
        } else {
            $cliente = Usuario::find($request->todosClientes);
            if ($cliente == null) {
                Flash("No se encontró el cliente, intente nuevamente.")->error()->important();
                return back();
            }
        }
        $carritoCollection = \Cart::getContent();
        if (count($carritoCollection) > 0) {
            foreach ($carritoCollection as $value) {
                if ($value->attributes->clienteId == 1) {
                    $nombreC = Usuario::select('nombre')->where('id', $value->attributes->clienteId)->value('nombre');
                } else {
                    $nombreC = Usuario::select(DB::raw('CONCAT(nombre, \' \', apellido) as nombreCompleto'))->where('id', $value->attributes->clienteId)->value('nombreCompleto');
                }
                if ($cliente->id == 1) {
                    $nombreR = Usuario::select('nombre')->where('id', $cliente->id)->value('nombre');
                } else {
                    $nombreR = $cliente->nombre . " " . $cliente->apellido;
                }
                if ($value->attributes->clienteId != $cliente->id) {
                    Flash("Usted no le está haciendo el pedido al cliente «" . $nombreR . "», usted está haciendo el pedido a nombre del cliente «" . $nombreC . "»")->error()->important();
                    return back();
                }
            }
        }
        if ($request->producto == 1) {
            $producto = Producto::find($request->producto);
        } else {
            $productos = Producto::all()->where('catalogo', 1)->where('id', '>', 1);
            return view('pedido.productos', compact("productos", "cliente"));
        }
        return view("pedido.crear", compact("cliente", "producto"));
    }
    public function crearProductoRegistrado($producto, $cliente, Request $request)
    {
        $cliente = Usuario::find($cliente);
        if ($cliente == null) {
            Flash("El cliente no se encontró")->error()->important();
            return redirect("/pedido/requisitos");
        }
        $carritoCollection = \Cart::getContent();
        foreach ($carritoCollection as $value) {
            if ($value->attributes->clienteId == 1) {
                $nombreC = Usuario::select('nombre')->where('id', $value->attributes->clienteId)->value('nombre');
            } else {
                $nombreC = Usuario::select(DB::raw('CONCAT(nombre, \' \', apellido) as nombreCompleto'))->where('id', $value->attributes->clienteId)->value('nombreCompleto');
            }
            if ($cliente->id == 1) {
                $nombreR = Usuario::select('nombre')->where('id', $cliente->id)->value('nombre');
            } else {
                $nombreR = $cliente->nombre . " " . $cliente->apellido;
            }
            if ($value->attributes->clienteId != $cliente->id) {
                Flash("Usted no le está haciendo el pedido al cliente «" . $nombreR . "», usted está haciendo el pedido a nombre del cliente «" . $nombreC . "»")->error()->important();
                return back();
            }
        }
        $producto = Producto::find($producto);
        if ($producto == null) {
            Flash("El producto no se encontró")->error()->important();
            return back();
        }
        return view("pedido.crear", compact("cliente", "producto"));
    }

    public function agregarCarritoPedido(Request $request)
    {
        $carritoCollection = \Cart::getContent();
        $producto = Producto::find($request->idProducto);
        $cliente = Usuario::find($request->idUser);
        if ($producto == null || $cliente == null) {
            Flash("No se encontró")->error()->important();
            return view('pedido.requisitos', compact("carritoCollection"));
        }
        $userId = $cliente;
        if ($userId->id == 1) {
            $userName = Usuario::select('nombre')->where('id', $userId->id)->value('nombre');
        } else {
            $userName = $userId->nombre . " " . $userId->apellido;
        }
        $userId = $userId->id;
        if ($request->idProducto == 1) {
            if ($request->img == null) {
                Flash("Por favor, ponga una imagen de referencia")->warning()->important();
                return view("pedido.crear", compact("cliente", "producto"));
            }
        }
        if (is_numeric($request->numeroPersonas) == false || is_numeric($request->pisos) == false) {
            Flash("Por favor, coloque un valor numérico en los campos «Número de personas» y «Pisos»")->warning()->important();
            return view("pedido.crear", compact("cliente", "producto"));
        }
        $producto = Producto::find($request->idProducto);
        if ($producto == null) {
            Flash::error("No se encontró el producto");
            return view("pedido.crear", compact("cliente", "producto"));
        }
        if ($producto->nombre != $request->productoNombre) {
            Flash::error("El nombre del producto no coincide");
            return view("pedido.crear", compact("cliente", "producto"));
        }
        $img = null;
        if ($request->img != null) {
            $img = $producto->nombre . '.' . time() . '.' . $request->img->extension();
            $request->img->move(public_path('imagenes'), $img);
        }

        $cotizacion = 0;
        $carritoCollection = \Cart::getContent();
        if (count($carritoCollection) <> 0) {
            foreach ($carritoCollection as $value) {
                $cotizacion = $value->attributes->idCotizacion;
            }
        }
        \Cart::add(array(
            'id' => $producto->id,
            'name' => $producto->nombre,
            'price' => 0,
            'quantity' => 1,
            'attributes' => array(
                'idCotizacion' => $cotizacion == null ? 0 : $cotizacion,
                'img' => $producto->img == null ? $img : $producto->img,
                'saborDeseado' => ucfirst($request->saborDeseado),
                'numeroPersonas' => $request->numeroPersonas,
                'frase' => ucfirst($request->frase),
                'pisos' => $request->pisos,
                'descripcionProducto' => ucfirst($request->descripcionProducto),
                'clienteId' => $userId,
                'cliente' => $userName,
                'imagen1' => $img,
            )
        ));
        $carritoCollection = \Cart::getContent();
        return view('pedido.carrito', compact("carritoCollection", "userId", "userName"));
    }
    public function limpiarCarritoPedido()
    {
        \Cart::clear();
        Flash("Se limpió el carrito")->success()->important();
        return redirect("/pedido");
    }

    public function quitar(Request $request)
    {
        $carritoCollection = \Cart::getContent();
        if (count($carritoCollection) > 1) {
            \Cart::remove($request->id);
        } else {
            Flash("Ojo, no puede quedar el pedido sin productos.")->warning()->important();
            $userId = Usuario::find($request->idUser);
            if ($userId == null) {
                Flash("No se encontró el cliente")->error()->warning();
                $carritoCollection = \Cart::getContent();
                return view('pedido.requisitos', compact("carritoCollection"));
            }
            if ($userId->id == 1) {
                $userName = Usuario::select('nombre')->where('id', $userId->id)->value('nombre');
            } else {
                $userName = $userId->nombre . " " . $userId->apellido;
            }
            $userId = $userId->id;
            $carritoCollection = \Cart::getContent();
            return view('pedido.carrito', compact("carritoCollection", "userId", "userName"));
        }
        Flash("Se removió correctamente el producto")->success()->important();
        $userId = Usuario::find($request->idUser);
        if ($userId == null) {
            Flash("No se encontró el cliente")->error()->warning();
            $carritoCollection = \Cart::getContent();
            return view('pedido.requisitos', compact("carritoCollection"));
        }
        if ($userId->id == 1) {
            $userName = Usuario::select('nombre')->where('id', $userId->id)->value('nombre');
        } else {
            $userName = $userId->nombre . " " . $userId->apellido;
        }
        $userId = $userId->id;
        $carritoCollection = \Cart::getContent();
        return view('pedido.carrito', compact("carritoCollection", "userId", "userName"));
    }
    public function actualizarPreProductos(Request $request)
    {
        $carritoCollection = \Cart::getContent();
        $userId = Usuario::find($request->idUser);
        if ($userId == null) {
            Flash::error("No se encuentra el cliente");
            return back();
        }
        if ($userId->id == 1) {
            $userName = Usuario::select('nombre')->where('id', $userId->id)->value('nombre');
        } else {
            $userName = $userId->nombre . " " . $userId->apellido;
        }
        $userId = $userId->id;

        $producto = \Cart::get($request->id);
        $productoBD = Producto::find($request->id);
        // dd($productoBD?'existe':'no existe');
        if ($producto == null || $productoBD == null) {
            Flash("No se encontró el producto")->error();
            return back();
        }
        if ($request->saborDeseado == null || $request->numeroPersonas == null || $request->pisos == null || $request->descripcionProducto == null) {
            Flash("Por favor, ingrese los campos requeridos del producto " . $producto->name)->error()->important();
            return view('pedido.carrito', compact("carritoCollection", "userId", "userName"));
        }
        if (is_numeric($request->numeroPersonas) == false || is_numeric($request->pisos) == false) {
            Flash("Por favor, coloque un valor numérico en los campos «Número de personas» y «Pisos» del producto " . $producto->name)->warning()->important();
            return view('pedido.carrito', compact("carritoCollection", "userId", "userName"));
        }

        $img = $producto->attributes->imagen1;
        if ($request->img != null) {
            $img = $producto->name . '.' . time() . '.' . $request->img->extension();
            $request->img->move(public_path('imagenes'), $img);
        }
        \Cart::update(
            $request->id,
            array(
                'attributes' => array(
                    // 'idCotizacion'=>$cotizacion==null?0:$cotizacion,
                    'img' => $producto->attributes->img == null ? $img : $producto->attributes->img,
                    'saborDeseado' => ucfirst($request->saborDeseado),
                    'numeroPersonas' => $request->numeroPersonas,
                    'frase' => ucfirst($request->frase),
                    'pisos' => $request->pisos,
                    'descripcionProducto' => ucfirst($request->descripcionProducto),
                    'clienteId' => $userId,
                    'cliente' => $userName,
                    'imagen1' => $img,
                )
            )
        );
        Flash("Producto actualizado")->success()->important();
        $carritoCollection = \Cart::getContent();
        return view('pedido.carrito', compact("carritoCollection", "userId", "userName"));
    }

    public function guardar(Request $request)
    {
        $productos = \Cart::getContent();
        $userId = Usuario::find($request->idUser);
        $carritoCollection = \Cart::getContent();
        if ($userId->id == 1) {
            $userName = Usuario::select('nombre')->where('id', $userId->id)->value('nombre');
        } else {
            $userName = $userId->nombre . " " . $userId->apellido;
        }
        $userId = $userId->id;
        if ($userId == null) {
            Flash("No se encontró el cliente")->error()->warning();
            return view('pedido.carrito', compact("carritoCollection", "userId", "userName"));
        }
        // dd($productos);
        $input = $request->all();
        // dd(Carbon::now()->addDays(3));
        if ($input["fechaEntrega"] < now() || $input["fechaEntrega"] < now()->addDays(3)) {
            Flash("No se puede poner la fecha de entrega antes de la fecha actual. También debes tener el cuenta que podría que estés poniendo la fecha muy cerca, mínimo con tres días de anticipación.")->error()->important();
            return view('pedido.carrito', compact("carritoCollection", "userId", "userName"));
        }
        if ($input["descripcionGeneral"] == null || $input["precio"] == null) {
            Flash("Por favor, rellene todos los campos")->warning()->important();
            return view('pedido.carrito', compact("carritoCollection", "userId", "userName"));
        }
        if (is_numeric($input["precio"]) == false) {
            Flash("Por favor, digite valores numéricos en el precio")->warning()->important();
            return view('pedido.carrito', compact("carritoCollection", "userId", "userName"));
        }
        try {
            DB::beginTransaction();
            $cotizacion = cotizacion::create([
                "idUser" => $input["idUser"],
                "fechaEntrega" => $input["fechaEntrega"],
                "descripcionGeneral" => ucfirst($input["descripcionGeneral"]),
                "estado" => 3,
            ]);
            foreach ($productos as $value) {
                // dd($value->id);
                detalle_cotizaciones::create([
                    "idCotizacion" => $cotizacion->id,
                    "idProducto" => $value->id,
                    "numeroPersonas" => $value->attributes->numeroPersonas,
                    "saborDeseado" => $value->attributes->saborDeseado,
                    "frase" => $value->attributes->frase,
                    "pisos" => $value->attributes->pisos,
                    "pisos" => $value->attributes->pisos,
                    "descripcionProducto" => $value->attributes->descripcionProducto,
                    "img" => $value->attributes->imagen1,
                ]);
            }
            $pedido = Pedido::create([
                "id" => $cotizacion->id,
                "idUser" => $cotizacion->idUser,
                "idCotizacion" => $cotizacion->id,
                "fechaEntrega" => $cotizacion->fechaEntrega,
                "descripcionGeneral" => $cotizacion->descripcionGeneral,
                "estado" => 1,
                "precio" => str_replace('.', '', $input["precio"])
            ]);
            $detalle = detalle_cotizaciones::select("cotizaciones.id as cotizacionid", "detalle_cotizaciones.*", "productos.nombre as producto", "productos.img as imagen", "productos.id as idProducto")
                ->join("cotizaciones", "detalle_cotizaciones.idCotizacion", "cotizaciones.id")
                ->join("productos", "productos.id", "detalle_cotizaciones.idProducto")
                ->where("cotizaciones.id", $cotizacion->id)
                ->get();
            foreach ($detalle as $value) {
                detalle_pedidos::create([
                    "idPedido" => $pedido->id,
                    "idCotizacion" => $value->idCotizacion,
                    "idProducto" => $value->idProducto,
                    "numeroPersonas" => $value->numeroPersonas,
                    "saborDeseado" => $value->saborDeseado,
                    "frase" => $value->frase,
                    "pisos" => $value->pisos,
                    "descripcionProducto" => $value->descripcionProducto,
                    "img" => $value->img,
                ]);
            }
            DB::commit();
            \Cart::clear();
            Flash("Se ha creado el pedido éxitosamente")->success()->important();
            return redirect("/pedido");
        } catch (\Exception $e) {
            DB::rollBack();
            Flash($e->getMessage())->error()->important();
            return redirect("/pedido");
        }
    }
    public function verImagen($imagen)
    {
        // $producto = pedido::where('id', $id)->firstOrFail();
        $mi_imagen = public_path() . '/imagenes/' . $imagen;
        // $imagen=storage_path("/imagenes/" . $producto->img);
        return response()->file($mi_imagen);
    }
    public function verDetalle($id)
    {
        $pedido = Pedido::find($id);
        if ($pedido == null) {
            Flash("No se encontró el pedido")->error()->important();
            return redirect("/pedido");
        }
        $nombreEstado = Pedido::select('estado_pedidos.nombre')
            ->join("estado_pedidos", "estado_pedidos.id", "pedidos.estado")
            ->where("pedidos.id", $id)
            ->value('nombre');

        $pedidoUsuario = Pedido::select('users.nombre')->join("users", "users.id", "pedidos.idUser")->where("pedidos.id", $pedido->id)->value("nombre");
        // SELECT cotizaciones.id, detalle_cotizaciones.*, productos.nombre FROM `detalle_cotizaciones` 
        // join cotizaciones on detalle_cotizaciones.idCotizacion=cotizaciones.id
        // join productos on productos.id=detalle_cotizaciones.idProducto
        // where cotizaciones.id=27
        $detallePedidos = detalle_pedidos::select("pedidos.id as cotizacionid", "detalle_pedidos.*", "productos.nombre as producto")
            ->join("pedidos", "detalle_pedidos.idPedido", "pedidos.id")
            ->join("productos", "productos.id", "detalle_pedidos.idProducto")
            ->where("pedidos.id", $id)
            ->get();
            // dd($detallePedidos);
        return view('pedido.ver', compact("detallePedidos", "pedido", "pedidoUsuario", "nombreEstado"));
    }
    //cada que se cambie el estado del pedido que notifique al cliente 

}
