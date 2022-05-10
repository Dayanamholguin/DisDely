<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Sabor;
use App\Http\Controllers\File;
use Illuminate\Support\Facades\DB;
//use Yajra\DataTables\DataTables;
use Illuminate\Http\UploadedFile;
use DataTables;
use Flash;
use PhpParser\Node\Stmt\Catch_;

class ProductoController extends Controller
{
    public function index()
    {
        return view('producto.index');
    }
    public function listar(Request $request)
    {
        $producto = Producto::select("productos.*", "categorias.nombre as cnombre", "sabores.nombre as snombre", "etapas.nombre as enombre")
            ->join("categorias", "productos.idCategoria", "categorias.id")
            ->join("sabores", "productos.idSabor", "sabores.id")
            ->join("etapas", "productos.idEtapa", "etapas.id")
            ->get();
        return DataTables::of($producto)
            ->editColumn("imagen", function ($producto) {
                $mi_imagen = public_path() . '/imagenes/' . $producto->img;
                if (@getimagesize($mi_imagen)) {
                    return "<img src='/" . "imagenes/" . $producto->img . "' width='60px' height='60px'>";
                } else {
                    return "<img src='/img/defecto.jpg' width='60px' height='60px'>";
                }
                //return "<img src='/".($producto->img==''?"imagenes/defecto.jpg":"imagenes/".$producto->img)."' width='100px' height='100px'>";
            })
            ->editColumn("estado", function ($producto) {
                return $producto->estado == 1 ? "Activo" : "Inactivo";
            })

            ->editColumn("acciones", function ($producto) {
                $acciones = '<a class="btn btn-primary btn-sm" href="/producto/editar/' . $producto->id . '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a> ';
                $acciones .= '<a class="btn btn-secondary btn-sm" href="/producto/ver/' . $producto->id . '" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fas fa-info-circle"></i></a> ';
                if ($producto->estado == 1) {
                    $acciones .= '<a class="btn btn-danger btn-sm" href="/producto/cambiar/estado/' . $producto->id . '/0" data-toggle="tooltip" data-placement="top" title="Inactivar"><i class="far fa-eye-slash"></i></a>';
                } else {
                    $acciones .= '<a class="btn btn-success btn-sm" href="/producto/cambiar/estado/' . $producto->id . '/1" data-toggle="tooltip" data-placement="top" title="Activar"><i class="far fa-eye"></i></a>';
                }
                return $acciones;
            })
            ->rawColumns(['acciones', 'imagen'])
            ->make(true);
    }
    
    public function catalogo(){
        $productos = Producto::all()->where('catalogo', 1);
        return view('producto.catalogo', compact("productos"));
    }

    public function crear()
    {
        $categorias = Categoria::all()->where('id', '>', 1)->where('estado', 1);
        $sabores = Sabor::all()->where('id', '>', 1)->where('estado', 1);
        $etapas = DB::table('etapas')->get()->where('id', '>', 1);
        return view('producto.crear', compact("categorias", "sabores", "etapas"));
    }

    public function guardar(Request $request)
    {
        $request->validate(Producto::$rules);
        $input = $request->all();
        $producto = Producto::select('*')->where('nombre', $request->nombre)->value('nombre');
        if ($producto != null) {
            Flash::error("El producto " . $producto . " ya está creado");
            return redirect("/producto/crear");
        }
        try {
            $imagen = null;
            if ($request->imagen != null) {
                $imagen = $input["nombre"] . '.' . time() . '.' . $request->imagen->extension();
                $request->imagen->move(public_path('imagenes'), $imagen);
            }else {
                Flash::error("La imagen es requerida, por favor, colóquela");
                return back();
            }
            Producto::create([
                "idCategoria" => $input["categoria"],
                "idSabor" => $input["sabor"],
                "idEtapa" => $input["etapa"],
                "nombre" => $input["nombre"],
                "descripcion" => $input["descripcion"],
                "numeroPersonas" => $input["numeroPersonas"],
                "pisos" => $input["pisos"],
                "catalogo" => $input["catalogo"],
                "img" => $imagen,
                "estado" => 1
            ]);
            Flash::success("Se ha creado éxitosamente");
            return redirect("/producto");
        } catch (\Exception $e) {
            Flash::error($e->getMessage());
            return redirect("/producto/crear");
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

    public function ver($id)
    {
        $producto = Producto::find($id);
        if ($producto == null) {
            Flash::error("No se encontró la producto");
            return redirect("/producto");
        }
        $categoria = Producto::select('categorias.nombre')->join("categorias", "productos.idCategoria", "categorias.id")->value('nombre');
        $sabor = Producto::select('sabores.nombre')->join("sabores", "productos.idsabor", "sabores.id")->value('nombre');
        $etapa = Producto::select('etapas.nombre')->join("etapas", "productos.idetapa", "etapas.id")->value('nombre');
        return view("producto.ver", compact("producto", "categoria", "sabor", "etapa"));
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
