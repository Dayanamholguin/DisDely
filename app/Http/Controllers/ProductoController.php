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

    /*
    ->editColumn("imagen", function ($producto) {
                $file ='/imagenes/'.$this->producto->img;
                if(is_file($file)){
                    return "<img src='/".("imagenes/".$producto->img)."' width='100px' height='100px'>";
                }else{
                    return "<img src='/imagenes/defecto.jpg' width='100px' height='100px'>";
                }
                return "<img src='/".($producto->img==null?"imagenes/defecto.jpg":"imagenes/".$producto->img)."' width='100px' height='100px'>";
            })
    
    */
    public function listar(Request $request)
    {
        $producto = Producto::select("productos.*", "categorias.nombre as cnombre", "sabores.nombre as snombre", "generos.nombre as gnombre", "etapas.nombre as enombre")
        ->join("categorias", "productos.idCategoria","categorias.id")
        ->join("sabores", "productos.idSabor", "sabores.id")
        ->join("generos", "productos.idGenero", "generos.id")
        ->join("etapas", "productos.idEtapa","etapas.id")
        ->get();
        return DataTables::of($producto)
            ->editColumn("imagen", function ($producto) {
                return "<img src='/".($producto->img==null?"imagenes/defecto.jpg":"imagenes/".$producto->img)."' width='100px' height='100px'>";
            })
            ->editColumn("estado", function ($producto) {
                return $producto->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('editar', function ($producto) {
                return '<a class="btn btn-primary btn-sm" href="/producto/editar/' . $producto->id . '"><i class="fas fa-edit"></i></a>';
            })
            ->addColumn('ver', function ($producto) {
                return '<a class="btn btn-secondary btn-sm" href="/producto/ver/' . $producto->id . '"><i class="fas fa-info-circle"></i></a>';
            })
            ->addColumn('cambiar', function ($producto) {
                if ($producto->estado == 1) {
                    return '<a class="btn btn-danger btn-sm" href="/producto/cambiar/estado/' . $producto->id . '/0"><i class="far fa-eye-slash"></i> Inactivar</a>';
                } else {
                    return '<a class="btn btn-success btn-sm" href="/producto/cambiar/estado/' . $producto->id . '/1"><i class="far fa-eye"></i> Activar</a>';
                }
            })
            ->rawColumns(['editar', 'cambiar', 'imagen', 'ver'])
            ->make(true);
    }
    public function crear()
    {
        $categorias = Categoria::all()->where('id','>',1)->where('estado',1);
        $sabores = Sabor::all()->where('id','>',1)->where('estado',1);
        $generos = DB::table('generos')->get()->where('id','>',1);
        //$generos = DB::table('generos')->get();
        $etapas = DB::table('etapas')->get()->where('id','>',1);
        return view('producto.crear', compact("categorias","sabores","generos","etapas"));
    }

    public function guardar(Request $request)
    {
        $request->validate(Producto::$rules);
        $input = $request->all();
        $producto = Producto::select('*')->where('nombre', $request->nombre)->value('nombre');
        if ($producto!=null) {
            Flash::error("El producto ".$producto." ya está creado");
            return redirect("/producto/crear");
        }
        try {
            $imagen = null;
            if($request->imagen != null){
                $imagen =$input["nombre"].'.'.time().'.'.$request->imagen->extension();
                $request->imagen->move(public_path('imagenes'), $imagen);
            }
            Producto::create([
                "idCategoria" => $input["categoria"],
                "idSabor" => $input["sabor"],
                "idGenero" => $input["genero"],
                "idEtapa" => $input["etapa"],
                "nombre" => $input["nombre"],
                "descripcion" => $input["descripcion"],
                "numeroPersonas" => $input["numeroPersonas"],
                "pisos" => $input["pisos"],
                "catalogo" => $input["catalogo"],
                "img"=>$imagen,
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
        $categorias = Categoria::all()->where('id','>',1)->where('estado',1);
        $sabores = Sabor::all()->where('id','>',1)->where('estado',1);
        $generos = DB::table('generos')->get()->where('id','>',1);
        $etapas = DB::table('etapas')->get()->where('id','>',1);
        $producto = Producto::find($id);        
        if ($producto == null) {   
            Flash::error("No se encontró el producto");      
            return redirect("/producto");
        }
        return view("producto.editar", compact("producto","categorias","sabores","generos","etapas"));
    }

    public function ver($id)
    {
        $producto = Producto::find($id);
        if ($producto == null) {   
            Flash::error("No se encontró la producto");      
            return redirect("/producto");
        }
        $categoria = Producto::select('categorias.nombre')->join("categorias", "productos.idCategoria","categorias.id")->value('nombre');
        $sabor = Producto::select('sabores.nombre')->join("sabores", "productos.idsabor","sabores.id")->value('nombre');
        $genero = Producto::select('generos.nombre')->join("generos", "productos.idgenero","generos.id")->value('nombre');
        $etapa = Producto::select('etapas.nombre')->join("etapas", "productos.idetapa","etapas.id")->value('nombre');
        return view("producto.ver", compact("producto", "categoria", "sabor","genero","etapa"));
    }

    public function modificar(Request $request)
    {
        $request->validate(Producto::$rules);
        $id=$request->id;
        $input = $request->all();
        $producto = Producto::select('*')->where('nombre', $request->nombre)->where('id','<>',$id)->value('nombre');
        if ($producto!=null) {
            Flash::error("El producto ".$producto." ya está creado");
            return redirect("/producto/editar/{$id}");
        }
        
        try {
            $producto = Producto::find($input["id"]);
            if ($producto == null) {
                Flash::error("No se encontró el producto");       
                return redirect("/producto");
            }
            /*$imagen = null;
            if($request->imagen != null){
                $imagen =$input["nombre"].'.'.time().'.'.$request->imagen->extension();
                $request->imagen->move(public_path('imagenes'), $imagen);
            }*/
            $producto->update([
                "idCategoria" => $input["categoria"],
                "idSabor" => $input["sabor"],
                "idGenero" => $input["genero"],
                "idEtapa" => $input["etapa"],
                "nombre" => $input["nombre"],
                "descripcion" => $input["descripcion"],
                "numeroPersonas" => $input["numeroPersonas"],
                "pisos" => $input["pisos"],
                "catalogo" => $input["catalogo"],
                //"img"=>$imagen,
                "estado" => 1
            ]);
            if ($request->hasFile('img')){
                $archivoFoto=$request->file('img');
                $nombreFoto=time().$archivoFoto->getClientOriginalName(); 
                $archivoFoto->move(public_path().'/imagenes/', $nombreFoto);        
                $producto->img=$nombreFoto; 
            }
            
            $producto->update(['img'=>$nombreFoto]);
              
            //$producto->update(['img'=>$nombreFoto]);
            /*if($request->hasFile('img'))
                {
                    $imagen=$request->file('img')->getClientOriginalName();
                    $request->file('img')->storeAs('imagenes/'.$producto->img);
                    $producto->update(['img'=>$imagen]);
                }*/
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
