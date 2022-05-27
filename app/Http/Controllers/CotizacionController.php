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
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use DataTables;
use Flash;
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
                $acciones = '<a class="btn btn-info btn-sm" href="/cotizacion/xxx/' . $cotizacion->id . '" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i> Editar</a> ';
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
        $input = $request->all();
        // dd(Carbon::now()->addDays(3));
        if ($input["fechaEntrega"]<now() || $input["fechaEntrega"]<now()->addDays(3)) {
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
            Flash::success("Se ha creado éxitosamente");
            return redirect("/producto/catalogo");
        } catch (\Exception $e) {
            DB::rollBack();
            Flash::error($e->getMessage());
            return redirect("/carrito");
        }
    }

    public function editar($id)
    {

        $categorias = Categoria::all()->where('id', '>', 1)->where('estado', 1);
        $sabores = Sabor::all()->where('id', '>', 1)->where('estado', 1);
        $etapas = DB::table('etapas')->get()->where('id', '>', 1);
        $producto = Producto::find($id);
        if ($producto == null) {
            Flash::error("No se encontró el producto");
            return redirect("/producto");
        }
        $mi_imagen = public_path() . '/imagenes/' . $producto->img;
        if (@getimagesize($mi_imagen)) {
            $producto->img = $producto->img;
            //return "<img src='/"."imagenes/".$producto->img."' width='100px' height='100px'>";
        } else {
            $producto->img = public_path() . '/img/defecto.jpg';
            //return "<img src='/img/defecto.jpg' width='100px' height='100px'>";
        }
        return view("producto.editar", compact("producto", "categorias", "sabores", "etapas"));
    }
    public function verDetalle($id)
    {
        $cotizacion = Cotizacion::find($id);
        if ($cotizacion == null) {
            Flash::error("No se encontró la cotización");
            return redirect("/cotizacion");
        }
        // SELECT cotizaciones.id, detalle_cotizaciones.*, productos.nombre FROM `detalle_cotizaciones` 
        // join cotizaciones on detalle_cotizaciones.idCotizacion=cotizaciones.id
        // join productos on productos.id=detalle_cotizaciones.idProducto
        // where cotizaciones.id=27
        $detalleCotizacion = detalle_cotizaciones::select("cotizaciones.id as cotizacionid","detalle_cotizaciones.*", "productos.nombre as producto")
        ->join("cotizaciones", "detalle_cotizaciones.idCotizacion", "cotizaciones.id")
        ->join("productos", "productos.id", "detalle_cotizaciones.idProducto")
        ->where("cotizaciones.id", $id)
        ->get();
        return view('cotizacion.ver', compact("detalleCotizacion"));
    }

    public function modificar(Request $request)
    {
        $request->validate(Producto::$rules);
        $id = $request->id;
        $input = $request->all();
        $producto = Producto::select('*')->where('nombre', $request->nombre)->where('id', '<>', $id)->value('nombre');
        if ($producto != null) {
            Flash::error("El producto " . $producto . " ya está creado");
            return redirect("/producto/editar/{$id}");
        }

        try {
            $producto = Producto::find($input["id"]);
            if ($producto == null) {
                Flash::error("No se encontró el producto");
                return redirect("/producto");
            }
            $producto->update([
                "idCategoria" => $input["categoria"],
                "idSabor" => $input["sabor"],
                "idEtapa" => $input["etapa"],
                "nombre" => $input["nombre"],
                "descripcion" => $input["descripcion"],
                "numeroPersonas" => $input["numeroPersonas"],
                "pisos" => $input["pisos"],
                "catalogo" => $input["catalogo"],
                //"img"=>$imagen,
                "estado" => 1
            ]);
            if ($request->hasFile('img')) {
                $archivoFoto = $request->file('img');
                $nombreFoto = time() . $archivoFoto->getClientOriginalName();
                $archivoFoto->move(public_path() . '/imagenes/', $nombreFoto);
                $producto->img = $nombreFoto;
                $producto->update(['img' => $nombreFoto]);
            }
            Flash::success("Se ha modificado éxitosamente");
            return redirect("/producto");
        } catch (\Exception $e) {
            Flash::error($e->getMessage());
            return redirect("/producto/editar/{$id}");
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
