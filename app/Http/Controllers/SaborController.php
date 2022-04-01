<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sabor;
use Yajra\DataTables\DataTables;

class SaborController extends Controller
{
    public function index()
    {

        return view('sabor.index');
    }

    public function listar(Request $request)
    {
        $sabores = Sabor::all();

        return DataTables::of($sabores)
            ->editColumn("estado", function ($sabor) {
                return $sabor->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('editar', function ($sabor) {
                return '<a class="btn btn-primary btn-sm" href="/sabor/editar/' . $sabor->id . '">Editar</a>';
            })
            ->addColumn('detalle', function ($sabor) {
                return '<a class="btn btn-info btn-sm" href="/sabor/show/' . $sabor->id . '">Ver</a>';
            })
            ->addColumn('cambiar', function ($sabor) {
                if ($sabor->estado == 1) {
                    return '<a class="btn btn-danger btn-sm" href="/sabor/cambiar/estado/' . $sabor->id . '/0">Inactivar</a>';
                } else {
                    return '<a class="btn btn-success btn-sm" href="/sabor/cambiar/estado/' . $sabor->id . '/1">Activar</a>';
                }
            })
            ->rawColumns(['editar', 'detalle', 'eambiar'])
            ->make(true);
    }

    public function create()
    {

        return view('sabor.create');
    }

    public function save(Request $request)
    {

        $request->validate(Sabor::$rules);
        $input = $request->all();

        try {
            Sabor::create([
                "nombre" => $input["nombre"],
                "estado" => 1
            ]);

            
            return redirect("/sabor");
        } catch (\Exception $e) {
          
            return redirect("/sabor/crear");
        }
    }

    public function edit($id)
    {

        $sabor = Sabor::find($id);

        if ($sabor == null) {
         
            return redirect("/sabor");
        }

        return view("sabor.edit", compact("sabor"));
    }

    public function update(Request $request)
    {

        $request->validate(Sabor::$rules);
        $input = $request->all();

        try {
            $sabor = Sabor::find($input["id"]);

            if ($sabor == null) {
            
                return redirect("/sabor");
            }

            $sabor->update([
                "nombre" => $input["nombre"]
            ]);

          
            return redirect("/sabor");
        } catch (\Exception $e) {
         
            return redirect("/sabor");
        }
    }

    public function updateState($id, $estado)
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
