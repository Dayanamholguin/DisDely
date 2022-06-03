<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
//use Yajra\DataTables\DataTables;
use DataTables;
use Flash;
use PhpParser\Node\Stmt\Catch_;

class CategoriaController extends Controller
{
    public function index()
    {
        return view('categoria.index');
    }

    public function listar(Request $request)
    {
        $categoria = Categoria::all()->where('id','>',1);
        return DataTables::of($categoria)
            ->editColumn("estado", function ($categoria) {
                return $categoria->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($categoria) {
                $acciones = '<a class="btn btn-info btn-sm" href="/categoria/editar/' . $categoria->id . '"><i class="fas fa-edit"></i> Editar</a> ';
            
                if ($categoria->estado == 1) {
                    $acciones .= '<a class="btn btn-danger btn-sm" href="/categoria/cambiar/estado/' . $categoria->id . '/0"><i class="bi bi-x-circle"></i> Inactivar</a>';
                } else {
                    $acciones .= '<a class="btn btn-success btn-sm" href="/categoria/cambiar/estado/' . $categoria->id . '/1"><i class="bi bi-check-circle"></i> Activar</a>';
                }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        return view('categoria.crear');
    }

    public function guardar(Request $request)
    {
        $request->validate(Categoria::$rules);
        $input = $request->all();
        $categoria = Categoria::select('*')->where('nombre', $request->nombre)->value('nombre');
        if ($categoria!=null) {
            Flash::error("La categoria ".$categoria." ya está creada");
            return redirect("/categoria/crear");
        }
        try {
            Categoria::create([
                "nombre" => ucfirst($input["nombre"]),
                "estado" => 1
            ]);
            Flash::success("Se ha creado éxitosamente");
            return redirect("/categoria");
        } catch (\Exception $e) {  
            Flash::error($e->getMessage());
            return redirect("/categoria/crear");
        }
    }

    public function editar($id)
    {
        $categoria = Categoria::find($id);        
        if ($categoria == null) {   
            Flash::error("No se encontró la categoria");      
            return redirect("/categoria");
        }
        return view("categoria.editar", compact("categoria"));
    }

    public function modificar(Request $request)
    {
        $request->validate(Categoria::$rules);
        $input = $request->all();

        $id=$request->id;
        $categoria = Categoria::select('*')->where('nombre',$request->nombre)->where('id','<>',$id)->value('nombre');
        
        if ($categoria!=null) {
            Flash::error("La categoria ".$categoria." ya está creada");
            return redirect("/categoria/editar/$id");
        }

        try {
            $categoria = Categoria::find($input["id"]);
            if ($categoria == null) {            
                return redirect("/categoria");
            }
            $categoria->update([
                "nombre" => $input["nombre"]
            ]);
            Flash::success("Se ha modificado éxitosamente");
            return redirect("/categoria");
        } catch (\Exception $e) {   
            Flash::error($e->getMessage());      
            return redirect("/categoria");
        }
    }

    public function modificarEstado($id, $estado)
    {
        $categoria = Categoria::find($id);
        if ($categoria == null) {        
            return redirect("/categoria");
        }
        try {
            $categoria->update(["estado" => $estado]);         
            return redirect("/categoria");
        } catch (\Exception $e) {       
            return redirect("/categoria");
        }
    }
}
