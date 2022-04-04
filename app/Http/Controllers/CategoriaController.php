<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Yajra\DataTables\DataTables;

class CategoriaController extends Controller
{
    public function index()
    {

        return view('categoria.index');
    }

    public function listar(Request $request)
    {
        $categorias = Categoria::all();

        return DataTables::of($categorias)
            ->editColumn("estado", function ($categoria) {
                return $categoria->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('editar', function ($categoria) {
                return '<a class="btn btn-primary btn-sm" href="/categoria/editar/' . $categoria->id . '">Editar</a>';
            })
            ->addColumn('cambiar', function ($categoria) {
                if ($categoria->estado == 1) {
                    return '<a class="btn btn-danger btn-sm" href="/categoria/cambiar/estado/' . $categoria->id . '/0">Inactivar</a>';
                } else {
                    return '<a class="btn btn-success btn-sm" href="/categoria/cambiar/estado/' . $categoria->id . '/1">Activar</a>';
                }
            })
            ->rawColumns(['editar', 'cambiar'])
            ->make(true);
    }

    public function create()
    {

        return view('categoria.create');
    }

    public function save(Request $request)
    {

        $request->validate(Categoria::$rules);
        $input = $request->all();

        try {
            Categoria::create([
                "nombre" => $input["nombre"],
                "imagen" => $input["imagen"],
                "estado" => 1
            ]);            
            return redirect("/categoria");

        } catch (\Exception $e) {          
            return redirect("/categoria/crear");
        }
    }

    public function edit($id)
    {

        $categoria = Categoria::find($id);

        if ($categoria == null) {
         
            return redirect("/categoria");
        }
        return view("categoria.edit", compact("categoria"));
    }

    public function update(Request $request)
    {

        $request->validate(Categoria::$rules);
        $input = $request->all();

        try {
            $categoria = Categoria::find($input["id"]);

            if ($categoria == null) {            
                return redirect("/categoria");
            }

            $categoria->update([
                "nombre" => $input["nombre"],
                "imagen" => $input["imagen"]
            ]);          
            return redirect("/categoria");

        } catch (\Exception $e) {
         
            return redirect("/categoria");
        }
    }

    public function updateState($id, $estado)
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
