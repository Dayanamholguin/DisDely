<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sabor;
//use Yajra\DataTables\DataTables;
use DataTables;
use Flash;

class SaborController extends Controller
{
    public function index()
    {
        return view('sabor.index');
    }

    public function listar(Request $request)
    {
        $sabores = Sabor::all()->where('id','>',1);
        return DataTables::of($sabores)
            ->editColumn("estado", function ($sabor) {
                return $sabor->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($sabor) {
                $acciones = '<a class="btn btn-primary btn-sm mb-1" href="/sabor/editar/' . $sabor->id . '"><i class="fas fa-edit"></i> Editar</a> ';
           
                if ($sabor->estado == 1) {
                    $acciones .= '<a class="btn btn-danger btn-sm mb-1" href="/sabor/cambiar/estado/' . $sabor->id . '/0"><i class="far fa-eye-slash"></i>Inactivar</a>';
                } else {
                    $acciones .= '<a class="btn btn-success btn-sm mb-1" href="/sabor/cambiar/estado/' . $sabor->id . '/1"><i class="fas fa-fw fa-eye"></i> Activar</a>';
                }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        return view('sabor.crear');
    }

    public function guardar(Request $request)
    {
        $request->validate(Sabor::$rules);
        $input = $request->all();
        $sabor = Sabor::select('*')->where('nombre', $request->nombre)->value('nombre');
        if ($sabor!=null) {
            Flash::error("El sabor ".$sabor." ya está creado");
            return redirect("/sabor/crear");
        }
        try {
            Sabor::create([
                "nombre" => $input["nombre"],
                "estado" => 1
            ]);
            Flash::success("Se ha creado éxitosamente");
            return redirect("/sabor");
        } catch (\Exception $e) {  
            Flash::error($e->getMessage());
            return redirect("/sabor/crear");
        }
    }

    public function editar($id)
    {
        $sabor = Sabor::find($id);        
        if ($sabor == null) {    
            Flash::error("No se encontró el sabor");     
            return redirect("/sabor");
        }
        return view("sabor.editar", compact("sabor"));
    }

    public function modificar(Request $request)
    {
        $request->validate(Sabor::$rules);
        $input = $request->all();

        $id=$request->id;
        $sabor = Sabor::select('*')->where('nombre',$request->nombre)->where('id','<>',$id)->value('nombre');
        if ($sabor!=null) {
            Flash::error("El sabor ".$sabor." ya está creado");
            return redirect("/sabor/editar/$id");
        }

        try {
            $sabor = Sabor::find($input["id"]);
            if ($sabor == null) {            
                return redirect("/sabor");
            }
            $sabor->update([
                "nombre" => $input["nombre"]
            ]);
            Flash::success("Se ha modificado éxitosamente");
            return redirect("/sabor");
        } catch (\Exception $e) {   
            Flash::error($e->getMessage());      
            return redirect("/sabor");
        }
    }

    public function modificarEstado($id, $estado)
    {
        $sabor = Sabor::find($id);
        if ($sabor == null) {        
            return redirect("/sabor");
        }
        try {
            $sabor->update(["estado" => $estado]);         
            return redirect("/sabor");
        } catch (\Exception $e) {       
            return redirect("/sabor");
        }
    }
}
