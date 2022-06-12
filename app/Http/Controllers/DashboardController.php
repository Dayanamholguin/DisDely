<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cotizacion;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Abono;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {   
        $usuario= User::find(Auth()->user()->id);
        if($usuario->hasRole('Admin')===false){
            Flash('No tienes permiso para el Dashboard')->error();
            return back();
        }
        $estados = DB::table('estado_cotizaciones')->get();        
        $data=[];
        foreach ($estados as $estado) {
            $data['estado'][] = $estado->nombre;
            $cotizacion = Cotizacion::select(DB::raw('count(*) as nEstado, estado'))
            ->where('estado', $estado->id)
            ->groupBy('estado')
            ->value('nEstado');
            $data['data'][] = $cotizacion;
        }
        $estadosPedido = DB::table('estado_pedidos')->get();        
        $dataPedido=[];
        foreach ($estadosPedido as $estado) {
            $dataPedido['estado'][] = $estado->nombre;
            $pedido = Pedido::select(DB::raw('count(*) as nEstado, estado'))
            ->where('estado', $estado->id)
            ->groupBy('estado')
            ->value('nEstado');
            $dataPedido['data'][] = $pedido;
        }
        $dataPago=[];
        $cantPago=0;
        $cantNoPago=0;
        $pedidos=Pedido::all();
        foreach ($pedidos as $pedido) {
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
                $cantPago++;
            }else {
                $cantNoPago++;
            }
            
        }
        $dataPago['nombre'][]="Pago";
        $dataPago['nombre'][]="No pago";
        $dataPago['data'][]=$cantPago;
        $dataPago['data'][]=$cantNoPago;
        // SELECT idProducto, productos.nombre as nombreProducto, count(idProducto) as cuantos FROM `detalle_cotizaciones`
        //  JOIN productos on detalle_cotizaciones.idProducto=productos.id GROUP BY 1 HAVING count(idProducto) 
        // ORDER BY `cuantos` DESC;
        $datosProductoCotizacion=[];
        $productos = Producto::select("idProducto","productos.nombre as nombreProducto")
        ->selectRaw('count(idProducto) as cuantos, idProducto')
        ->join("detalle_cotizaciones", "productos.id", "detalle_cotizaciones.idProducto")
        ->groupByRaw("idProducto, nombreProducto")
        ->havingRaw("count(idProducto)")
        ->orderByDesc("cuantos")
        ->limit(3)
        ->get();
        foreach ($productos as $value) {
            $datosProductoCotizacion['nombre'][]=$value->nombreProducto;
            $datosProductoCotizacion['data'][]=$value->cuantos;
        }

        $datosProductoPedido=[];
        $productosPedido = Producto::select("idProducto","productos.nombre as nombreProducto")
        ->selectRaw('count(idProducto) as cuantos, idProducto')
        ->join("detalle_pedidos", "productos.id", "detalle_pedidos.idProducto")
        ->groupByRaw("idProducto, nombreProducto")
        ->havingRaw("count(idProducto)")
        ->orderByDesc("cuantos")
        ->limit(3)
        ->get();
        foreach ($productosPedido as $value) {
            $datosProductoPedido['nombre'][]=$value->nombreProducto;
            $datosProductoPedido['data'][]=$value->cuantos;
        }
        // SELECT idUser, users.nombre as nombreUsuario, count(idUser) as cuantos FROM `users` JOIN pedidos on pedidos.idUser=users.id GROUP BY 1 HAVING count(idUser) ORDER BY `cuantos` DESC;
        $clientes=[];
        $ClienteP = User::select("idUser")
        ->selectRaw('CONCAT(users.nombre, \' \', users.apellido) as nombreCompleto')
        ->selectRaw('count(idUser) as cuantos, idUser')
        ->join("pedidos", "pedidos.idUser", "users.id")
        ->groupByRaw("idUser, nombreCompleto")
        ->havingRaw("count(idUser)")
        ->orderByDesc("cuantos")
        ->limit(3)
        ->get();
        // dd($ClienteP);
        foreach ($ClienteP as $value) {
            $clientes['nombre'][]=$value->nombreCompleto;
            $clientes['data'][]=$value->cuantos;
        }
        $clientesCotizacion=[];
        $ClienteC = User::select("idUser")
        ->selectRaw('CONCAT(users.nombre, \' \', users.apellido) as nombreCompleto')
        ->selectRaw('count(idUser) as cuantos, idUser')
        ->join("cotizaciones", "cotizaciones.idUser", "users.id")
        ->groupByRaw("idUser, nombreCompleto")
        ->havingRaw("count(idUser)")
        ->orderByDesc("cuantos")
        ->limit(3)
        ->get();
        // dd($ClienteC);
        foreach ($ClienteC as $value) {
            $clientesCotizacion['nombre'][]=$value->nombreCompleto;
            $clientesCotizacion['data'][]=$value->cuantos;
        }
        return view('Dashboard.index', compact("data", "dataPedido", "dataPago", "datosProductoCotizacion", "datosProductoPedido", "clientes", "clientesCotizacion"));
    }


    // public function index3()
    // {   
    //     $usuario= User::find(Auth()->user()->id);
    //     if($usuario->hasRole('Admin')===false){
    //         Flash('No tienes permiso para el Dashboard')->error();
    //         return back();
    //     }
    //     $estados = DB::table('estado_cotizaciones')->get();        
    //     $data=[];
    //     foreach ($estados as $estado) {
    //         $data['estado'][] = $estado->nombre;
    //         $cotizacion = Cotizacion::select(DB::raw('count(*) as nEstado, estado'))
    //         ->where('estado', $estado->id)
    //         ->groupBy('estado')
    //         ->value('nEstado');
    //         $data['data'][] = $cotizacion;
    //     }
    //     return view('Dashboard.index', compact("data"));
    // }
}
