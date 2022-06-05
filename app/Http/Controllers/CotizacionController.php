<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\detalle_cotizaciones;
use App\Models\detalle_pedidos;
use App\Models\Pedido;
use App\Models\cotizacion;
use App\Http\Controllers\File;
use Illuminate\Support\Facades\DB;
//use Yajra\DataTables\DataTables;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use DataTables;
use Jenssegers\Date\Date;
use Flash;
use Cart;
use PhpParser\Node\Stmt\Catch_;

class CotizacionController extends Controller
{
    public function index()
    {
        return view('cotizacion.index');
    }
    public function listar(Request $request)
    {
        $cotizacion = cotizacion::select("cotizaciones.*", "users.nombre as usuario", "estado_cotizaciones.nombre as estado")
            ->join("users", "users.id", "cotizaciones.idUser")
            ->join("estado_cotizaciones", "estado_cotizaciones.id", "cotizaciones.estado")
            ->get();

        return DataTables::of($cotizacion)
            ->editColumn('estado', function($cotizacion){
                if($cotizacion->estado=="Aprobada"){
                    return '<p class="badge badge-success p-2">'.$cotizacion->estado.'</p>';
                }elseif($cotizacion->estado=="Rechazada"){
                    return '<p class="badge badge-danger p-2">'.$cotizacion->estado.'</p>';
                }elseif($cotizacion->estado=="Pendiente"){
                    return '<p class="badge badge-secondary p-2">'.$cotizacion->estado.'</p>';
                }
            })
            ->editColumn('fechaEntrega', function($cotizacion){
                return ucwords(Date::create($cotizacion->fechaEntrega)->format('l, j F Y'));
            })
            ->editColumn('acciones', function ($cotizacion) {
                if ($cotizacion->estado =="Pendiente") {
                    $acciones = '<a class="btn btn-info btn-sm" href="/cotizacion/editar/' . $cotizacion->id . '" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i> Editar</a> ';
                }else
                {
                    $acciones = '<a class="btn btn-info btn-sm disabled" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i> Editar</a> ';
                }
                $acciones .= '<a class="btn btn-secondary btn-sm" href="/cotizacion/ver/' . $cotizacion->id . '" data-toggle="tooltip" data-placement="top"><i class="fas fa-info-circle"></i> Ver</a> ';
                return $acciones;
            })
            ->rawColumns(['acciones', 'estado'])
            ->make(true);
    }
    public function crear($id)
    {
        $producto = Producto::find($id);
        if ($producto == null) {
            Flash("No se encontró el producto")->error()->important();
            return redirect("/producto/catalogo");
        }
        return view('cotizacion.crear', compact("producto"));
    }
    public function Personalizada()
    {
        $producto = Producto::find(1);
        return view('cotizacion.crearPersonalizada', compact("producto"));
    }

    public function guardar(Request $request)
    {
        $productos = \Cart::getContent();
        // dd($productos);
        $input = $request->all();
        // dd(Carbon::now()->addDays(3));
        if ($input["fechaEntrega"] < now() || $input["fechaEntrega"] < now()->addDays(3)) {
            Flash("No se puede poner la fecha de entrega antes de la fecha actual. También debes tener el cuenta que podría que estés poniendo la fecha muy cerca, mínimo con tres días de anticipación.")->error()->important();
            return back();
        }
        try {
            DB::beginTransaction();
            $cotizacion = cotizacion::create([
                "idUser" => $input["idUser"],
                "fechaEntrega" => $input["fechaEntrega"],
                "descripcionGeneral" => ucfirst($input["descripcionGeneral"]),
                "estado" => 1,
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
            DB::commit();
            \Cart::clear();
            Flash("Se ha creado la cotización éxitosamente")->success()->important();
            return redirect("/cotizacion");
        } catch (\Exception $e) {
            DB::rollBack();
            Flash($e->getMessage())->error()->important();
            return redirect("/cotizacion");
        }
    }

    public function cancelar()
    {
        Cart::clear();
        return redirect("/cotizacion");
    }

    public function editar($id)
    {
        // \Cart::clear();
        $estadosCotizacion = DB::table('estado_cotizaciones')->get();

        $cotizacion = Cotizacion::find($id);
        if ($cotizacion == null) {
            Flash("No se encontró la cotización")->error()->important();
            return redirect("/cotizacion");
        }

        $estado = Cotizacion::select('estado_cotizaciones.id')->join("estado_cotizaciones", "estado_cotizaciones.id", "cotizaciones.estado")->where("cotizaciones.id", $id)->value('id');
        $estadoNombre = Cotizacion::select('estado_cotizaciones.nombre')->join("estado_cotizaciones", "estado_cotizaciones.id", "cotizaciones.estado")->where("cotizaciones.id", $id)->value('nombre');

        if ($estado != 1 || $estadoNombre != "Pendiente") {
            Flash("Las cotizaciones solo se pueden editar si está en estado «Pendiente».")->warning()->important();
            return back();
        }
        $carritoCollection = \Cart::getContent();
        // dd(\Cart::getContent());
        $detalleCotizacion = detalle_cotizaciones::select("cotizaciones.id as cotizacionid", "detalle_cotizaciones.*", "productos.nombre as producto", "productos.img as imagen", "productos.id as idProducto")
            ->join("cotizaciones", "detalle_cotizaciones.idCotizacion", "cotizaciones.id")
            ->join("productos", "productos.id", "detalle_cotizaciones.idProducto")
            ->where("cotizaciones.id", $id)
            ->get();
        $cotizacionUsuario = Cotizacion::select(DB::raw('CONCAT(users.nombre, \' \', users.apellido) as nombreCompleto'))
            ->join("users", "users.id", "cotizaciones.idUser")
            ->where("cotizaciones.id", $id)
            ->value("nombreCompleto");
            // ->get()->pluck('nombreCompleto');
        if (count($carritoCollection) <> 0) {
            foreach ($carritoCollection as $value) {
                // dd($value->attributes->idCotizacion."  ".$cotizacion->id);
                if (intval($value->attributes->idCotizacion) !== intval($cotizacion->id)) {
                    Flash("Debes terminar de editar la cotización " . $value->attributes->idCotizacion . " antes de ingresar a otra cotización")->error()->important();
                    return redirect("/cotizacion");
                }
            }
        } else {
            foreach ($detalleCotizacion as $value) {
                \Cart::add(array(
                    'id' => $value->idProducto,
                    'name' => $value->producto,
                    'price' => 0,
                    'quantity' => 1,
                    'attributes' => array(
                        'idCotizacion' => $cotizacion->id,
                        'img' => $value->img == null ? $value->imagen : $value->img,
                        'saborDeseado' => $value->saborDeseado,
                        'numeroPersonas' => $value->numeroPersonas,
                        'frase' => $value->frase,
                        'pisos' => $value->pisos,
                        'descripcionProducto' => $value->descripcionProducto,
                        'clienteId' => $cotizacion->idUser,
                        'cliente' => $cotizacionUsuario,
                        'imagen1' => $value->img,
                    )
                ));
            }
        }
        $carritoCollection = \Cart::getContent();
        return view("cotizacion.editar", compact("cotizacion", "cotizacionUsuario", "carritoCollection", "estadosCotizacion"));
    }
    public function verDetalle($id)
    {
        $cotizacion = Cotizacion::find($id);
        if ($cotizacion == null) {
            Flash("No se encontró la cotización")->error()->important();
            return redirect("/cotizacion");
        }
        $nombreEstado = Cotizacion::select('estado_cotizaciones.nombre')
            ->join("estado_cotizaciones", "estado_cotizaciones.id", "cotizaciones.estado")
            ->where("cotizaciones.id", $id)
            ->value('nombre');

        $cotizacionUsuario = Cotizacion::select('users.nombre')->join("users", "users.id", "cotizaciones.idUser")->where("cotizaciones.id", $cotizacion->id)->value("nombre");
        // SELECT cotizaciones.id, detalle_cotizaciones.*, productos.nombre FROM `detalle_cotizaciones` 
        // join cotizaciones on detalle_cotizaciones.idCotizacion=cotizaciones.id
        // join productos on productos.id=detalle_cotizaciones.idProducto
        // where cotizaciones.id=27
        $detalleCotizacion = detalle_cotizaciones::select("cotizaciones.id as cotizacionid", "detalle_cotizaciones.*", "productos.nombre as producto")
            ->join("cotizaciones", "detalle_cotizaciones.idCotizacion", "cotizaciones.id")
            ->join("productos", "productos.id", "detalle_cotizaciones.idProducto")
            ->where("cotizaciones.id", $id)
            ->get();

            // dd($detalleCotizacion);
        return view('cotizacion.ver', compact("detalleCotizacion", "cotizacion", "cotizacionUsuario", "nombreEstado"));
    }

    public function modificar(Request $request)
    {
        $cotizacion = Cotizacion::find($request->idCotizacion);
        if ($cotizacion == null) {
            Flash("No se encontró esa cotización")->error()->important();
            return back();
        }
        $request->validate(Cotizacion::$rules);
        $input = $request->all();
        if ($input["fechaEntrega"] < now()) {
            Flash("No se puede poner la fecha de entrega antes de la fecha actual.")->error()->important();
            return back();
        }
        $detalleCotizacion = detalle_cotizaciones::select("cotizaciones.id as cotizacionid", "detalle_cotizaciones.*", "productos.nombre as producto", "productos.img as imagen", "productos.id as idProducto")
            ->join("cotizaciones", "detalle_cotizaciones.idCotizacion", "cotizaciones.id")
            ->join("productos", "productos.id", "detalle_cotizaciones.idProducto")
            ->where("cotizaciones.id", $cotizacion->id)
            ->get();
        // $detalleCotizacion=detalle_cotizaciones::all()->where("idCotizacion", $request->idCotizacion);
        $productos = \Cart::getContent();
        try {
            DB::beginTransaction();
            $cotizacion->update([
                "fechaEntrega" => $input["fechaEntrega"],
                "descripcionGeneral" => $input["descripcionGeneral"],
                "estado" => $input["estado"],
            ]);

            foreach ($productos as $value) {
                foreach ($detalleCotizacion as $item) {
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
                    $consultasql = detalle_cotizaciones::select("idProducto")
                        ->join("cotizaciones", "cotizaciones.id", "detalle_cotizaciones.idCotizacion") // $value->attributes->idCotizacion)
                        ->where('detalle_cotizaciones.idCotizacion', $value->attributes->idCotizacion)
                        ->where('detalle_cotizaciones.idProducto', $value->id)
                        ->value("idProducto");
                    if ($consultasql == null) {
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
                }
            }
            $detalleNueva = detalle_cotizaciones::select("cotizaciones.id as cotizacionid", "detalle_cotizaciones.*", "productos.nombre as producto", "productos.img as imagen", "productos.id as idProducto")
                ->join("cotizaciones", "detalle_cotizaciones.idCotizacion", "cotizaciones.id")
                ->join("productos", "productos.id", "detalle_cotizaciones.idProducto")
                ->where("cotizaciones.id", $cotizacion->id)
                ->get();
                
            $productosNuevo = \Cart::getContent()->toArray();
            foreach ($detalleNueva as $value) {
                if (array_search($value->idProducto, array_column($productosNuevo, 'id')) === false) {
                    $producto = detalle_cotizaciones::select("*")
                        ->join("cotizaciones", "detalle_cotizaciones.idCotizacion", "cotizaciones.id")
                        ->join("productos", "productos.id", "detalle_cotizaciones.idProducto")
                        ->where("cotizaciones.id", $cotizacion->id)
                        ->where("idProducto", $value->idProducto);
                    $producto->delete();
                }
            }
                        
            if ($cotizacion->estado == 3) {
                $campos = [
                    'precio' => ['required', 'numeric', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
                ];
                $this->validate($request, $campos);
                // dd();
                $pedido = Pedido::create([
                    "id" => $cotizacion->id,
                    "idUser" => $cotizacion->idUser,
                    "idCotizacion" => $cotizacion->id,
                    "fechaEntrega" => $cotizacion->fechaEntrega,
                    "descripcionGeneral" => $cotizacion->descripcionGeneral,
                    "estado" => 1,
                    "precio" => str_replace('.','', $input["precio"])
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
                        "img" => $value->img,  //cambié el imagen1 por img, el atributo de cotizaciones
                    ]);
                }
                DB::commit();
                \Cart::clear();
                Flash("Se ha hecho un pedido éxitosamente")->success()->important();
                return redirect("/cotizacion");
            }
            DB::commit();
            \Cart::clear();
            Flash::success("Se ha actualizado la cotización éxitosamente");
            return redirect("/cotizacion");
        } catch (\Exception $e) {
            DB::rollBack();
            Flash($e->getMessage())->error()->important();
            return redirect("/cotizacion");
        }
    }

    public function modificarEstado($id, $estado)
    {
        $producto = Producto::find($id);
        if ($producto == null) {
            return redirect("/producto");
        }
        try {
            $producto->update(["estado" => $estado]);
            return redirect("/producto");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/producto");
        }
    }
}
