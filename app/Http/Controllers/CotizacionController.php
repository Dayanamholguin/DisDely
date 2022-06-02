<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\detalle_cotizaciones;
use App\Models\Sabor;
use App\Models\cotizacion;
use App\Http\Controllers\File;
use Illuminate\Support\Facades\DB;
//use Yajra\DataTables\DataTables;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use DataTables;
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
            // ->editColumn("fechaEntrega", function ($cotizacion) {
            //     return $cotizacion->fechaEntrega->toDayDateTimeString();
            // })
            ->editColumn('acciones', function ($cotizacion) {
                $acciones = '<a class="btn btn-info btn-sm" href="/cotizacion/editar/' . $cotizacion->id . '" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i> Editar</a> ';
                $acciones .= '<a class="btn btn-secondary btn-sm" href="/cotizacion/ver/' . $cotizacion->id . '" data-toggle="tooltip" data-placement="top"><i class="fas fa-info-circle"></i> Ver</a> ';
                // if ($cotizacion->estado == 1) {
                //     $acciones .= '<a class="btn btn-danger btn-sm " href="/cotizacion/cambiar/estado/' . $cotizacion->id . '/0" data-toggle="tooltip" data-placement="top"><i class="bi bi-x-circle"></i> Inactivar</a>';
                // } else {
                //     $acciones .= '<a class="btn btn-success btn-sm " href="/cotizacion/cambiar/estado/' . $cotizacion->id . '/1" data-toggle="tooltip" data-placement="top"><i class="bi bi-check-circle"></i> Activar</a>';
                // }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }
    public function crear($id)
    {
        $producto = Producto::find($id);
        if ($producto == null) {
            Flash::error("No se encontró el producto");
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
            Flash::error("No se puede poner la fecha de entrega antes de la fecha actual. También debes tener el cuenta que podría que estés poniendo la fecha muy cerca, mínimo con tres días de anticipación.");
            return back();
        }
        try {
            DB::beginTransaction();
            $cotizacion = cotizacion::create([
                "idUser" => $input["idUser"],
                "fechaEntrega" => $input["fechaEntrega"],
                "descripcionGeneral" => $input["descripcionGeneral"],
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
            Flash::success("Se ha creado la cotización éxitosamente");
            return redirect("/cotizacion");
        } catch (\Exception $e) {
            DB::rollBack();
            Flash::error($e->getMessage());
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
        $cotizacion = Cotizacion::find($id);
        if ($cotizacion == null) {
            Flash::error("No se encontró la cotización");
            return redirect("/cotizacion");
        }
        $carritoCollection = \Cart::getContent();
        // dd(\Cart::getContent());
        $detalleCotizacion = detalle_cotizaciones::select("cotizaciones.id as cotizacionid", "detalle_cotizaciones.*", "productos.nombre as producto", "productos.img as imagen", "productos.id as idProducto")
            ->join("cotizaciones", "detalle_cotizaciones.idCotizacion", "cotizaciones.id")
            ->join("productos", "productos.id", "detalle_cotizaciones.idProducto")
            ->where("cotizaciones.id", $id)
            ->get();
        // dd($detalleCotizacion);
        $cotizacionUsuario = Cotizacion::select('users.nombre')
            ->join("users", "users.id", "cotizaciones.idUser")
            ->where("cotizaciones.id", $id)
            ->value("nombre");

        // dd($cotizacionUsuario);
        if (count($carritoCollection) <> 0) {
            foreach ($carritoCollection as $value) {
                // dd($value->attributes->idCotizacion."  ".$cotizacion->id);
                if (intval($value->attributes->idCotizacion) !== intval($cotizacion->id)) {
                    Flash::error("Debes terminar de editar la cotización " . $value->attributes->idCotizacion . " antes de ingresar a otra cotización");
                    return redirect("/cotizacion");
                }
            }
            if (count($carritoCollection) > 0) {
                // Flash("Ojo, no puede quedar la cotización sin productos, porque si remueve todos los productos de la cotización, toma los productos que tenía anteriormente")->warning()->important();
            }
            // dd($carritoCollection);
        } else {
            foreach ($detalleCotizacion as $value) {
                // dd($value->imagen);
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
        // dd($carritoCollection);
        return view("cotizacion.editar", compact("cotizacion", "cotizacionUsuario", "carritoCollection"));
    }
    public function verDetalle($id)
    {
        $cotizacion = Cotizacion::find($id);
        if ($cotizacion == null) {
            Flash::error("No se encontró la cotización");
            return redirect("/cotizacion");
        }
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
        return view('cotizacion.ver', compact("detalleCotizacion", "cotizacion", "cotizacionUsuario"));
    }

    public function modificar(Request $request)
    {
        $cotizacion = Cotizacion::find($request->idCotizacion);
        if ($cotizacion == null) {
            Flash("No se encontró esa cotización")->error()->important();
            return back();
        }
        $input = $request->all();
        if ($input["fechaEntrega"] < now() || $input["fechaEntrega"] < now()->addDays(3)) {
            Flash("No se puede poner la fecha de entrega antes de la fecha actual. También debes tener el cuenta que podría que estés poniendo la fecha muy cerca, mínimo con tres días de anticipación.")->error()->important();
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
                // "idUser" => $input["idUser"],
                "fechaEntrega" => $input["fechaEntrega"],
                "descripcionGeneral" => $input["descripcionGeneral"],
                "estado" => 1,
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
                        ->join("cotizaciones","cotizaciones.id","detalle_cotizaciones.idCotizacion")// $value->attributes->idCotizacion)
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
            DB::commit();
            \Cart::clear();
            Flash::success("Se ha actualizado la cotización éxitosamente");
            return redirect("/cotizacion");
        } catch (\Exception $e) {
            DB::rollBack();
            Flash::error($e->getMessage());
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
            Flash::error($e->getMessage());
            return redirect("/producto");
        }
    }
}
