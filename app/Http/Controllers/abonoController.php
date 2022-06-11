<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\Models\detalle_pedidos;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;
use App\Models\Abono;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use DataTables;
use Flash;
use Carbon\Carbon;

class abonoController extends Controller
{
    public function index()
    {
        return view('abono.index');
    }
    public function listar(Request $request)
    {
        Date::setLocale('es');
       
        $user=User::find(Auth()->user()->id);
        if ($user->hasRole('Admin')==false) {
            $pedido = Pedido::select("pedidos.*", "pedidos.estado as idEstado", "users.nombre as usuario","users.apellido as Pusuario", "estado_pedidos.nombre as estado")
            ->join("users", "users.id", "pedidos.idUser")
            ->join("estado_pedidos", "estado_pedidos.id", "pedidos.estado")
            ->where("users.id", Auth::user()->id)
            ->get();
        }else {
            $pedido = Pedido::all();
        }
        return DataTables::of($pedido)
            ->editColumn('fecha', function ($pedido) {
                return ucwords(Date::create($pedido->created_at)->format('l, j F Y'));
            })
            ->editColumn('idPedido', function ($pedido) {
                return '<a class="alert-link titulo" href="/pedido/ver/' . $pedido->id . '" >'. $pedido->id .'</a> ';
            })
            ->editColumn('acciones', function ($pedido) {
                $usuarioEnSesion = User::findOrFail(auth()->user()->id);
                $acciones=null; 
                if($usuarioEnSesion->can('abono/ver')){
                    $acciones = '<a class="btn btn-info btn-sm" href="/abono/verAbonoPedido/' . $pedido->id . '" ><i class="fas fa-info-circle"></i> Ver abono de los pedidos</a> ';
                }
                return $acciones;
            })
            ->rawColumns(['acciones', 'fecha', 'idPedido'])
            ->make(true);
    }
    public function crear($id)
    {
        $pedido = Pedido::find($id);
        if ($pedido == null) {
            Flash("No se encontró el pedido")->error()->important();
            return redirect("/pedido");
        }


        $precio = Pedido::select('precio')->where('pedidos.id', $pedido->id)->value('precio');
        $abonos = Abono::select("*")->where('idPedido', $pedido->id)->get();
        $nAbonos = 0;
        if (count($abonos) > 0) {
            foreach ($abonos as $value) {
                $nAbonos += $value->precioPagar;
            }
        }
        if ($nAbonos == $precio) {
            Flash("Ya pagó el pedido " . $pedido->id . ", por tanto, no es posible realizar abonos del mismo")->warning()->important();
            return redirect("/pedido");
        }


        if ($pedido->idUser == 1) {
            $nombreCliente = Pedido::select('users.nombre')->join('users', 'users.id', 'pedidos.idUser')->where('pedidos.id', $pedido->id)->value('nombre');
        } else {
            $nombreCliente = Pedido::select(DB::raw('CONCAT(users.nombre, \' \', users.apellido) as nombreCompleto'))->join('users', 'users.id', 'pedidos.idUser')->where('pedidos.id', $pedido->id)->value('nombreCompleto');
        }

        // dd($pedido->id);
        $abonos = Abono::select("*")->where('idPedido', $pedido->id)->get();
        $nAbonos = 0;
        $resta = 0;
        if (count($abonos) > 0) {
            foreach ($abonos as $value) {
                $nAbonos += $value->precioPagar;
            }
            $resta = $pedido->precio - $nAbonos;
        }

        return view("abono.crear", compact("pedido", "nombreCliente", "abonos", "nAbonos", "resta"));
    }
    public function verAbonoPedido($id)
    {
        $pedido=Pedido::find($id);
        if ($pedido==null) {
            Flash('No se encontró el pedido')->error()->important();
            return back();
        }
        $abonos = Abono::select("*")->where('idPedido', $pedido->id)->get();
        return view("abono.verAbonoPedido", compact("pedido", "abonos"));
    }
    public function guardar(Request $request)
    {
        $request->validate(Abono::$rules);
        $pedido = Pedido::find($request->idPedido);
        if ($pedido == null) {
            Flash("No se encontró el pedido")->error()->important();
            return back();
        }
        if ($pedido->idUser == 1) {
            $nombreCliente = Pedido::select('users.nombre')->join('users', 'users.id', 'pedidos.idUser')->where('pedidos.id', $pedido->id)->value('nombre');
        } else {
            $nombreCliente = Pedido::select(DB::raw('CONCAT(users.nombre, \' \', users.apellido) as nombreCompleto'))->join('users', 'users.id', 'pedidos.idUser')->where('pedidos.id', $pedido->id)->value('nombreCompleto');
        }
        if ($nombreCliente != $request->nombre) {
            Flash("No coincide el nombre de la persona que hizo la cotización")->error()->important();
            return back();
        }
        $input = $request->all();
        $precioFormulario = intval(str_replace('.', '', $input["precioPagar"]));
        $precio = Pedido::select('precio')->where('pedidos.id', $pedido->id)->value('precio');
        $abonos = Abono::select("*")->where('idPedido', $pedido->id)->get();
        $nAbonos = 0;
        $resta = 0;
        if (count($abonos) > 0) {
            foreach ($abonos as $value) {
                $nAbonos += $value->precioPagar;
            }
            $resta = $pedido->precio - $nAbonos;
        }
        if ($nAbonos == $precio) {
            Flash("Ya pagó el pedido " . $pedido->id . ", por tanto, no es posible realizar abonos del mismo")->warning()->important();
            return redirect("/pedido");
        }
        if ($resta > 0) {
            if ($precioFormulario > $resta) {
                Flash("Solo resta " . number_format($resta, 0, '.', '.') . ", por favor, digite nuevamente el precio")->error()->important();
                return back();
            }
        }
        try {
            $imagen = null;
            if ($request->img != null) {
                $imagen = $input["nombre"] . '.' . time() . '.' . $request->img->extension();
                $request->img->move(public_path('comprobantes'), $imagen);
            }
            Abono::create([
                "idPedido" => $pedido->id,
                "precioPagar" => $precioFormulario,
                "img" => $imagen
            ]);
            Flash("Se ha registrado el abono del pedido " . $pedido->id . " éxitosamente")->success()->important();
            return redirect("/pedido");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/pedido");
        }
    }
    public function ver($id)
    {
        $pedido = Pedido::find($id);
        if ($pedido == null) {
            Flash("No se encontró el pedido")->error()->important();
            return redirect("/pedido");
        }
        // number_format(pPrecio, 0, '.', '.')
        $cliente = Pedido::select('users.*')->join('users', 'users.id', 'pedidos.idUser')->where('pedidos.id', $pedido->id)->get();
        // dd($cliente);
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
        $porcentaje = intval($porcentaje);
        return view("abono.ver", compact("pedido", "cliente", "abonos", "nAbonos", "resta", "precio", "paga", "porcentaje"));
    }
    
    public function verImagen($imagen)
    {
        // $producto = pedido::where('id', $id)->firstOrFail();
        $mi_imagen = public_path() . '/comprobantes/' . $imagen;
        // $imagen=storage_path("/imagenes/" . $producto->img);
        return response()->file($mi_imagen);
    }
    // Cuando se haga un abono se notifique al correo del usuario que hizo el pedido
}
