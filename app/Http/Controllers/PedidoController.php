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
    public function requisitos()
    {
        return view('pedido.requisitos');
    }
    public function buscarUsuarios(){
        $Cliente = Usuario::select("*")->where("users.id", ">", 2)->where("estado", 1)->get();
        return $Cliente;
    }
    public function crear(Request $request)
    {
        $campos = [
            'cliente' => ['in:1,2'],
            'producto' => ['in:1,2'],
        ];
        $this->validate($request, $campos);
        if ($request->cliente==1) {
            $cliente = Usuario::find($request->cliente);
        }else {
            $cliente = Usuario::find($request->todosClientes);
            if ($cliente==null) {
                Flash("No se encontró el cliente, intente nuevamente.")->error()->important();
                return back();
            }
        }
        if($request->producto==1){
            $producto = Producto::find($request->producto);
        }else {
            $productos = Producto::all()->where('catalogo', 1)->where('id', '>', 1);
            return view('pedido.productos', compact("productos","cliente"));
        }
        return view("pedido.crear", compact("cliente", "producto"));
    }
    public function crearProductoRegistrado($producto, $cliente, Request $request )
    {
        $producto = Producto::find($producto);
        if ($producto==null) {
            Flash("El producto no se encontró")->error()->important();
            return back();
        }
        $cliente = Usuario::find($cliente);
        if ($cliente==null) {
            Flash("El cliente no se encontró")->error()->important();
            return redirect("/pedido/requisitos");
        }
        return view("pedido.crear", compact("cliente", "producto"));
    }

    // validar en el guardar si el producto es diferente de uno, para poder hacer el require de la imagen 
    // que se necesita obligatoria o si es producto normal no necesita tener imagen obligarioa
}
