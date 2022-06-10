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
            ->where("productos.id", ">", 1)
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
            ->editColumn("categoria", function ($producto) {
                return $producto->cnombre;
            })
            ->editColumn("sabor", function ($producto) {
                return $producto->snombre;
            })
            ->editColumn("acciones", function ($producto) {
                $acciones = '<a class="btn btn-info btn-sm" href="/producto/editar/' . $producto->id . '" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i> Editar</a> ';
                $acciones .= '<a class="btn btn-secondary btn-sm" href="/producto/ver/' . $producto->id . '" data-toggle="tooltip" data-placement="top"><i class="fas fa-info-circle"></i> Ver</a> ';
                if ($producto->estado == 1) {
                    $acciones .= '<a class="btn btn-danger btn-sm" href="/producto/cambiar/estado/' . $producto->id . '/0" data-toggle="tooltip" data-placement="top"><i class="bi bi-x-circle"></i> Inactivar</a>';
                } else {
                    $acciones .= '<a class="btn btn-success btn-sm" href="/producto/cambiar/estado/' . $producto->id . '/1" data-toggle="tooltip" data-placement="top"><i class="bi bi-check-circle"></i> Activar</a>';
                }
                return $acciones;
            })
            ->rawColumns(['acciones', 'imagen'])
            ->make(true);
    }

    public function catalogo()
    {
        // $categorias = Categoria::all()->where('id', '>', 1)->where('estado', 1);
        $productos = Producto::all()->where('catalogo', 1)->where('id', '>', 1);
        return view('producto.catalogo', compact("productos"));
    }

    public function verProductoCatalogo($id)
    {
        if ($id == 1) {
            Flash("No se puede ver el producto personalizado")->error()->important();
            return redirect("/producto/catalogo");
        }
        $producto = Producto::find($id);
        if ($producto == null) {
            Flash("No se encontró el producto")->error()->important();
            return redirect("/producto/catalogo");
        }
        $categoria = Producto::select('categorias.nombre')->join("categorias", "productos.idCategoria", "categorias.id")->where("productos.id",$id)->value('nombre');
        $sabor = Producto::select('sabores.nombre')->join("sabores", "productos.idsabor", "sabores.id")->where("productos.id",$id)->value('nombre');
        $etapa = Producto::select('etapas.nombre')->join("etapas", "productos.idetapa", "etapas.id")->where("productos.id",$id)->value('nombre');
        return view("producto.verProductoCatalogo", compact("producto", "categoria", "sabor", "etapa"));
    }


    public function crear()
    {
        $categorias = Categoria::select('*')->where('id', '>', 1)->where('estado', 1)->orderBy('nombre', 'asc')->get();
        $sabores = Sabor::select('*')->where('id', '>', 1)->where('estado', 1)->orderBy('nombre', 'asc')->get();
        $etapas = DB::table('etapas')->get()->where('id', '>', 1);
        return view('producto.crear', compact("categorias", "sabores", "etapas"));
    }

    public function guardar(Request $request)
    {
        $request->validate(Producto::$rules);
        $input = $request->all();
        $producto = Producto::select('*')->where('nombre', $request->nombre)->value('nombre');
        if ($producto != null) {
            Flash("El producto " . $producto . " ya está creado")->error()->important();
            return redirect("/producto/crear");
        }
        try {
            $imagen = null;
            if ($request->imagen != null) {
                $imagen = $input["nombre"] . '.' . time() . '.' . $request->imagen->extension();
                $request->imagen->move(public_path('imagenes'), $imagen);
            } else {
                Flash("La imagen es requerida, por favor, colóquela")->error()->important();
                return redirect("/producto/crear");
            }
            Producto::create([
                "idCategoria" => $input["categoria"],
                "idSabor" => $input["sabor"],
                "idEtapa" => $input["etapa"],
                "nombre" => ucfirst($input["nombre"]),
                "descripcion" => ucfirst($input["descripcion"]),
                "numeroPersonas" => $input["numeroPersonas"],
                "pisos" => $input["pisos"],
                "catalogo" => $input["catalogo"],
                "img" => $imagen,
                "estado" => 1
            ]);
            Flash("Se ha creado éxitosamente")->success()->important();
            return redirect("/producto");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/producto/crear");
        }
    }

    public function editar($id)
    {

        $categorias = Categoria::all()->where('id', '>', 1)->where('estado', 1);
        $sabores = Sabor::all()->where('id', '>', 1)->where('estado', 1);
        $etapas = DB::table('etapas')->get()->where('id', '>', 1);


        if ($id == 1) {
            Flash("No se puede editar el producto personalizado")->error()->important();
            return redirect("/producto");
        }

        $producto = Producto::find($id);
        if ($producto == null) {
            Flash("No se encontró el producto")->error()->important();
            return redirect("/producto");
        }
        $mi_imagen = public_path() . '/imagenes/' . $producto->img;
        if (is_file($mi_imagen)) {
            $producto->img = $producto->img;
        } else {
            $producto->img = '/img/defecto.jpg';
        }
        return view("producto.editar", compact("producto", "categorias", "sabores", "etapas"));
    }

    public function ver($id)
    {
        if ($id == 1) {
            Flash("No se puede ver el producto personalizado")->error()->important();
            return redirect("/producto");
        }
        $producto = Producto::find($id);
        if ($producto == null) {
            Flash("No se encontró el producto")->error()->important();
            return redirect("/producto");
        }
        $mi_imagen = public_path() . '/imagenes/' . $producto->img;
        if (is_file($mi_imagen)) {
            $producto->img = $producto->img;
        } else {
            $producto->img = '/img/defecto.jpg';
        }
        
        $categoria = Producto::select('categorias.nombre')->join("categorias", "productos.idCategoria", "categorias.id")->where("productos.id",$id)->value('nombre');
        $sabor = Producto::select('sabores.nombre')->join("sabores", "productos.idsabor", "sabores.id")->where("productos.id",$id)->value('nombre');
        $etapa = Producto::select('etapas.nombre')->join("etapas", "productos.idetapa", "etapas.id")->where("productos.id",$id)->value('nombre');
        // dd($sabor);
        return view("producto.ver", compact("producto", "categoria", "sabor", "etapa"));
    }
    public function verProductoAjax($id) {
        $producto = Producto::find($id);
        // $productoCompleto = Producto::select("productos.*", "categorias.nombre as categoria", "sabores.nombre as sabor", "etapas.nombre as etapa")
        // ->join("categorias", "productos.idCategoria", "categorias.id")
        // ->join("sabores", "productos.idsabor", "sabores.id")
        // ->join("etapas", "productos.idetapa", "etapas.id")
        // ->where("productos.id",$id)
        // ->get();
        $categoria = Producto::select('categorias.nombre')->join("categorias", "productos.idCategoria", "categorias.id")->where("productos.id",$id)->value('nombre');
        $sabor = Producto::select('sabores.nombre')->join("sabores", "productos.idsabor", "sabores.id")->where("productos.id",$id)->value('nombre');
        $etapa = Producto::select('etapas.nombre')->join("etapas", "productos.idetapa", "etapas.id")->where("productos.id",$id)->value('nombre');
        return compact("producto", "categoria", "sabor", "etapa");
    }
    public function modificar(Request $request)
    {
        if ($request->id == 1) {
            Flash("No se puede editar el producto personalizado")->error()->important();
            return redirect("/producto");
        }
        $request->validate(Producto::$rules);
        $id = $request->id;
        $input = $request->all();
        $producto = Producto::select('*')->where('nombre', $request->nombre)->where('id', '<>', $id)->value('nombre');
        if ($producto != null) {
            Flash("El producto " . $producto . " ya está creado")->error()->important();
            return redirect("/producto/editar/{$id}");
        }

        try {
            $producto = Producto::find($input["id"]);
            if ($producto == null) {
                Flash("No se encontró el producto")->error()->important();
                return redirect("/producto");
            }
            $estado=$input["catalogo"]==0?$estado=0:$estado=1;
            $producto->update([
                "idCategoria" => $input["categoria"],
                "idSabor" => $input["sabor"],
                "idEtapa" => $input["etapa"],
                "nombre" => ucfirst($input["nombre"]),
                "descripcion" => ucfirst($input["descripcion"]),
                "numeroPersonas" => $input["numeroPersonas"],
                "pisos" => $input["pisos"],
                "catalogo" => $input["catalogo"],
                //"img"=>$imagen,
                "estado" => $estado
            ]);
            if ($request->hasFile('img')) {
                $archivoFoto = $request->file('img');
                $nombreFoto = time() . $archivoFoto->getClientOriginalName();
                $archivoFoto->move(public_path() . '/imagenes/', $nombreFoto);
                $producto->img = $nombreFoto;
                $producto->update(['img' => $nombreFoto]);
            }
            Flash("Se ha modificado éxitosamente")->success()->important();
            return redirect("/producto");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/producto/editar/{$id}");
        }
    }

    public function modificarEstado($id, $estado)
    {
        if ($id == 1) {
            Flash("No se puede modificar el estado el producto personalizado")->error()->important();
            return redirect("/producto");
        }
        $producto = Producto::find($id);
        if ($producto == null) {
            Flash("No se encontró el producto")->error()->important();
            return redirect("/producto");
        }
        $catalogo = $estado==0?$catalogo=0:$catalogo=1;
        try {
            $producto->update([
                "estado" => $estado,
                "catalogo" => $catalogo
            ]);
            return redirect("/producto");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/producto");
        }
    }
}
