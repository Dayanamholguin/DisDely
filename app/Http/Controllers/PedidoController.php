<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\Models\Producto;
use App\Models\detalle_cotizaciones;
use App\Models\detalle_pedidos;
use App\Models\Pedido;
use App\Models\Abono;
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
        $pedido = Pedido::select("pedidos.*", "pedidos.estado as idEstado", "users.nombre as usuario","users.apellido as Pusuario", "estado_pedidos.nombre as estado")
            ->join("users", "users.id", "pedidos.idUser")
            ->join("estado_pedidos", "estado_pedidos.id", "pedidos.estado")
            ->get();
        // DB::raw("DATEDIFF(date_from,date_to)AS Days"))
        // SELECT DATEDIFF((SELECT fechaEntrega FROM `pedidos` WHERE id = 6), NOW())
        // $nombreC = Usuario::select(DB::raw('CONCAT(nombre, \' \', apellido) as nombreCompleto'))->where('id', $value->attributes->clienteId)->value('nombreCompleto');

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
            ->editColumn('cliente', function ($pedido) {
                if ($pedido->idUser==1) {
                    $nombre = $pedido->usuario;
                }else {
                    $nombre = $pedido->usuario. " ".$pedido->Pusuario;
                }
                return $nombre;
            })
            ->addColumn('verFechas', function ($pedido) {
                $fecha = Pedido::select('fechaEntrega')->where('id', $pedido->id)->value("fechaEntrega");
                $date1 = Carbon::parse($fecha);
                $date2 = now();
                $fechaPedido = intval($date1->format('d')) - intval($date2->format('d'));
                if ($pedido->idEstado != 3) {
                    if ($fechaPedido == 3) {
                        return '<span class="badge badge-warning text-white p-2">' . 'Faltan ' . $fechaPedido . ' día(s)' . '</span>';
                    } elseif ($fechaPedido == 2) {
                        return '<span class="badge badge-info text-white p-2">' . 'Faltan ' . $fechaPedido . ' día(s)' . '</span>';
                    } elseif ($fechaPedido == 1) {
                        return '<span class="badge badge-danger text-white p-2">' . 'Faltan ' . $fechaPedido . ' día(s)' . '</span>';
                    } elseif ($fechaPedido == 0) {
                        return '<span class="badge badge-success text-white p-2">' . 'Se entrega hoy' . '</span>';
                    } elseif ($fechaPedido < 0) {
                        return "Se pasó el día de la entrega";
                    }
                    return "Faltan " . $fechaPedido . " día(s)";
                } else {
                    return "Se anuló el pedido";
                }
            })
            ->addColumn('pagos', function ($pedido) {
                $precio = Pedido::select('precio')->where('pedidos.id', $pedido->id)->value('precio');
                $abonos = Abono::select("*")->where('idPedido', $pedido->id)->get();
                $nAbonos = 0;
                if (count($abonos) > 0) {
                    foreach ($abonos as $value) {
                        $nAbonos += $value->precioPagar;
                    }
                }
                if ($nAbonos == $precio) {
                    return '<span class="badge badge-success text-white p-2">' . 'Pedido pago' . '</span>';
                }else {
                    return '<span class="badge badge-warning text-white p-2">' . 'Proceso de abono ' . '</span>';
                }
            })
            ->editColumn('acciones', function ($pedido) {
                $acciones = '<a class="btn btn-info btn-sm" href="/pedido/editar/' . $pedido->id . '" ><i class="fas fa-edit"></i></a> ';
                $acciones .= '<a class="btn btn-secondary btn-sm" href="/pedido/ver/' . $pedido->id . '" ><i class="fas fa-info-circle"></i></a> ';
                
                $precio = Pedido::select('precio')->where('pedidos.id', $pedido->id)->value('precio');
                $abonos = Abono::select("*")->where('idPedido', $pedido->id)->get();
                $nAbonos = 0;
                if (count($abonos) > 0) {
                    foreach ($abonos as $value) {
                        $nAbonos += $value->precioPagar;
                    }
                }
                if ($nAbonos != $precio) {
                    $acciones .= '<a class="btn btn-success btn-sm" href="/abono/crear/' . $pedido->id . '" ><i class="fas fa-dollar-sign"></i> Abono</a> ';
                }

                $acciones .= '<a class="btn btn-dark btn-sm" href="/abono/ver/' . $pedido->id . '" ><i class="fas fa-dollar-sign"></i></a> ';
                return $acciones;
            })
            ->rawColumns(['acciones', 'estado', 'verFechas', 'pagos', 'cliente'])
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

        if (count($carritoCollection) <> 0) {
            foreach ($carritoCollection as $value) {
                if ($value->attributes->clienteId != $cliente->id) {
                    Flash::error("No coincide el nombre del cliente al que le está haciendo el pedido");
                    return view("pedido.crear", compact("cliente", "producto"));
                }
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
        // dd($cotizacion);
        if ($cotizacion > 0) {
            return redirect("/pedido/editar/{$cotizacion}");
        }
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

    public function actualizarProductosPedido(Request $request)
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
        $cotizacion = 0;
        $carritoCollection = \Cart::getContent();
        if (count($carritoCollection) <> 0) {
            foreach ($carritoCollection as $value) {
                $cotizacion = $value->attributes->idCotizacion;
            }
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
                    'idCotizacion' => $cotizacion == null ? 0 : $cotizacion,
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
        return redirect("/pedido/editar/{$cotizacion}");
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

    public function cancelarP()
    {
        Cart::clear();
        return redirect("/pedido");
    }

    public function editar($id)
    {
        // \Cart::clear();
        $estadosPedido = DB::table('estado_pedidos')->get();

        $pedido = Pedido::find($id);
        if ($pedido == null) {
            Flash("No se encontró el pedido")->error()->important();
            return redirect("/pedido");
        }
        // dd($pedido->id);
        $estado = Pedido::select('estado_pedidos.id')->join("estado_pedidos", "estado_pedidos.id", "pedidos.estado")->where("pedidos.id", $id)->value('id');
        $estadoNombre = Pedido::select('estado_pedidos.nombre')->join("estado_pedidos", "estado_pedidos.id", "pedidos.estado")->where("pedidos.id", $id)->value('nombre');

        if ($estado != 1 || $estadoNombre != "En espera") {
            Flash("El pedido solo se pueden editar si está en estado «En espera».")->warning()->important();
            return back();
        }
        $carritoCollection = \Cart::getContent();
        // dd(\Cart::getContent());
        $detallePedido = detalle_pedidos::select("pedidos.id as pedidoid", "detalle_pedidos.*", "productos.nombre as producto", "productos.img as imagen", "productos.id as idProducto")
            ->join("pedidos", "detalle_pedidos.idPedido", "pedidos.id")
            ->join("productos", "productos.id", "detalle_pedidos.idProducto")
            ->where("pedidos.id", $id)
            ->get();
        $pedidoUsuario = Pedido::select(DB::raw('CONCAT(users.nombre, \' \', users.apellido) as nombreCompleto'))
            ->join("users", "users.id", "pedidos.idUser")
            ->where("pedidos.id", $id)
            ->value("nombreCompleto");
        if ($pedido->idUser == 1 || $pedidoUsuario == "Cliente genérico") {
            $pedidoUsuario = Pedido::select('users.nombre')
                ->join("users", "users.id", "pedidos.idUser")
                ->where("pedidos.id", $id)
                ->value("nombre");
        }


        // ->get()->pluck('nombreCompleto');
        if (count($carritoCollection) <> 0) {
            // dd(count($carritoCollection));
            foreach ($carritoCollection as $value) {
                // dd($value->attributes->idCotizacion!==$pedido->id?'diferente':'iuales');
                if (intval($value->attributes->idCotizacion) !== intval($pedido->id)) {
                    Flash("Debes terminar de editar el pedido " . $value->attributes->idCotizacion . " antes de ingresar a otro pedido")->error()->important();
                    return redirect("/pedido");
                }
            }
        } else {
            foreach ($detallePedido as $value) {
                \Cart::add(array(
                    'id' => $value->idProducto,
                    'name' => $value->producto,
                    'price' => 0,
                    'quantity' => 1,
                    'attributes' => array(
                        'idCotizacion' => $pedido->id,
                        'img' => $value->img == null ? $value->imagen : $value->img,
                        'saborDeseado' => $value->saborDeseado,
                        'numeroPersonas' => $value->numeroPersonas,
                        'frase' => $value->frase,
                        'pisos' => $value->pisos,
                        'descripcionProducto' => $value->descripcionProducto,
                        'clienteId' => $pedido->idUser,
                        'cliente' => $pedidoUsuario,
                        'imagen1' => $value->img,
                    )
                ));
            }
        }
        $carritoCollection = \Cart::getContent();
        return view("pedido.editar", compact("pedido", "pedidoUsuario", "carritoCollection", "estadosPedido"));
    }

    public function modificar(Request $request)
    {
        $carritoCollection = \Cart::getContent();
        $pedido = Pedido::find($request->idPedido);

        $pedidoUsuario = Pedido::select(DB::raw('CONCAT(users.nombre, \' \', users.apellido) as nombreCompleto'))
            ->join("users", "users.id", "pedidos.idUser")
            ->where("pedidos.id", $pedido->id)
            ->value("nombreCompleto");

        $estadosPedido = DB::table('estado_pedidos')->get();
        if ($pedido->idUser == 1 || $pedidoUsuario == "Cliente genérico") {
            $pedidoUsuario = Pedido::select('users.nombre')
                ->join("users", "users.id", "pedidos.idUser")
                ->where("pedidos.id", $pedido->id)
                ->value("nombre");
        }

        // falta validar los values del estado
        if ($pedido == null) {
            Flash("No se encontró ese pedido")->error()->important();
            return view("pedido.editar", compact("pedido", "pedidoUsuario", "carritoCollection", "estadosPedido"));
        }

        if ($request->fechaEntrega < now()) {
            Flash("No se puede poner la fecha de entrega antes de la fecha actual.")->error()->important();
            return back();
        }

        if ($request->descripcionGeneral == null || $request->precio == null) {
            Flash("Por favor, rellene todos los campos")->warning()->important();
            return view("pedido.editar", compact("pedido", "pedidoUsuario", "carritoCollection", "estadosPedido"));
        }
        if (is_numeric($request->precio == false)) {
            Flash("Por favor, digite valores numéricos en el precio")->warning()->important();
            return view("pedido.editar", compact("pedido", "pedidoUsuario", "carritoCollection", "estadosPedido"));
        }

        foreach ($carritoCollection as $value) {

            if ($value->attributes->clienteId != $pedido->idUser) {
                Flash("No coincide el nombre del cliente al que le está haciendo el pedido")->error()->important();
                return view("pedido.editar", compact("pedido", "pedidoUsuario", "carritoCollection", "estadosPedido"));
            }
        }
        $input = $request->all();

        $detallePedido = detalle_pedidos::select("pedidos.id as pedidoid", "detalle_pedidos.*", "productos.nombre as producto", "productos.img as imagen", "productos.id as idProducto")
            ->join("pedidos", "detalle_pedidos.idPedido", "pedidos.id")
            ->join("productos", "productos.id", "detalle_pedidos.idProducto")
            ->where("pedidos.id", $pedido->id)
            ->get();

        // $detalleCotizacion=detalle_cotizaciones::all()->where("idCotizacion", $request->idCotizacion);
        $productos = \Cart::getContent();

        try {
            DB::beginTransaction();
            $pedido->update([
                "fechaEntrega" => $input["fechaEntrega"],
                "descripcionGeneral" => $input["descripcionGeneral"],
                "estado" => $input["estado"],
                "precio" => str_replace('.', '', $input["precio"]),
            ]);

            // dd($productos);
            foreach ($productos as $value) {

                foreach ($detallePedido as $item) {

                    if ($value->id == $item->idProducto) {
                        $item->update([
                            "numeroPersonas" => $value->attributes->numeroPersonas,
                            "saborDeseado" => $value->attributes->saborDeseado,
                            "frase" => $value->attributes->frase,
                            "pisos" => $value->attributes->pisos,
                            "descripcionProducto" => $value->attributes->descripcionProducto,
                            "img" => $value->attributes->imagen1,
                        ]);
                    }
                    // select idProducto from detalle_cotizaciones
                    // join cotizaciones on cotizaciones.id = detalle_cotizaciones.idCotizacion
                    // where (detalle_cotizaciones.idCotizacion = 1) and (detalle_cotizaciones.idProducto=5)
                    // dd($value->id);

                    // dd($value->attributes->idPedido);
                    $consultasql = detalle_pedidos::select("idProducto")
                        ->join("pedidos", "pedidos.id", "detalle_pedidos.idPedido") // $value->attributes->idCotizacion)
                        ->where('detalle_pedidos.idPedido', $value->attributes->idCotizacion)
                        ->where('detalle_pedidos.idProducto', $value->id)
                        ->value("idProducto");

                    if ($consultasql == null) {
                        detalle_pedidos::create([
                            "idPedido" => $pedido->id,
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
                }
            }

            // dd($id);

            $detalleNueva = detalle_pedidos::select("pedidos.id as pedidoid", "detalle_pedidos.*", "productos.nombre as producto", "productos.img as imagen", "productos.id as idProducto")
                ->join("pedidos", "detalle_pedidos.idPedido", "pedidos.id")
                ->join("productos", "productos.id", "detalle_pedidos.idProducto")
                ->where("pedidos.id", $pedido->id)
                ->get();

            $productosNuevo = \Cart::getContent()->toArray();
            foreach ($detalleNueva as $value) {
                if (array_search($value->idProducto, array_column($productosNuevo, 'id')) === false) {
                    $producto = detalle_pedidos::select("*")
                        ->join("pedidos", "detalle_pedidos.idPedido", "pedidos.id")
                        ->join("productos", "productos.id", "detalle_pedidos.idProducto")
                        ->where("pedidos.id", $pedido->id)
                        ->where("idProducto", $value->idProducto);
                    $producto->delete();
                }
            }
            DB::commit();
            \Cart::clear();
            Flash::success("Se ha actualizado el pedido éxitosamente");
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

        // $cliente = Pedido::select('users.nombre')->join("users", "users.id", "pedidos.idUser")->where("pedidos.id", $pedido->id)->value("nombre");
        $cliente = Pedido::select('users.*')->join('users', 'users.id', 'pedidos.idUser')->where('pedidos.id', $pedido->id)->get();
        // SELECT cotizaciones.id, detalle_cotizaciones.*, productos.nombre FROM `detalle_cotizaciones` 
        // join cotizaciones on detalle_cotizaciones.idCotizacion=cotizaciones.id
        // join productos on productos.id=detalle_cotizaciones.idProducto
        // where cotizaciones.id=27
        $detallePedidos = detalle_pedidos::select("pedidos.id as cotizacionid", "detalle_pedidos.*", "productos.nombre as producto")
            ->join("pedidos", "detalle_pedidos.idPedido", "pedidos.id")
            ->join("productos", "productos.id", "detalle_pedidos.idProducto")
            ->where("pedidos.id", $id)
            ->get();

        $precio = Pedido::select('precio')->where('pedidos.id', $pedido->id)->value('precio');
        $abonos = Abono::select("*")->where('idPedido', $pedido->id)->get();
        $nAbonos = 0;
        $resta = 0;
        $paga=false;
        if (count($abonos) > 0) {
            foreach ($abonos as $value) {
                $nAbonos += $value->precioPagar;
            }
            $resta = $pedido->precio - $nAbonos;
        }
        if ($nAbonos==$precio) {
            $paga=true;
        }
        $porcentaje = ($nAbonos*100)/$precio;
        // dd($detallePedidos);
        return view('pedido.ver', compact("detallePedidos", "pedido", "cliente", "nombreEstado", "paga", "porcentaje"));
    }
    //cada que se cambie el estado del pedido que notifique al cliente 

}
