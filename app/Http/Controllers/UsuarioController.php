<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
//use Yajra\DataTables\DataTables;
use Illuminate\Http\UploadedFile;
use DataTables;
use Flash;
use PhpParser\Node\Stmt\Catch_;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('usuario.index');
    }

    public function listar(Request $request)
    {
        $usuario = Usuario::select("users.*", "generos.nombre as gnombre")
        ->join("generos", "users.idGenero", "generos.id")
        ->get();
        return DataTables::of($usuario)
            ->editColumn("estado", function ($usuario) {
                return $usuario->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('editar', function ($usuario) {
                return '<a class="btn btn-primary btn-sm" href="/usuario/editar/' . $usuario->id . '"><i class="fas fa-edit"></i></a>';
            })
            ->addColumn('ver', function ($usuario) {
                return '<a class="btn btn-secondary btn-sm" href="/usuario/ver/' . $usuario->id . '"><i class="fas fa-info-circle"></i></a>';
            })
            ->addColumn('cambiar', function ($usuario) {
                if ($usuario->estado == 1) {
                    return '<a class="btn btn-danger btn-sm" href="/usuario/cambiar/estado/' . $usuario->id . '/0"><i class="far fa-eye-slash"></i> Inactivar</a>';
                } else {
                    return '<a class="btn btn-success btn-sm" href="/usuario/cambiar/estado/' . $usuario->id . '/1"><i class="far fa-eye"></i> Activar</a>';
                }
            })
            //->rawColumns(['editar', 'cambiar', 'imagen', 'ver'])
            ->rawColumns(['editar', 'ver', 'cambiar'])
            ->make(true);
    }

    public function crear()
    {
        $generos = DB::table('generos')->get()->where('id','>',1);
        return view('usuario.crear', compact("generos"));
    }

    public function guardar(Request $request)
    {
        $request->validate(Usuario::$rules);
        $input = $request->all();
        $usuario = Usuario::select('*')->where('nombre', $request->nombre)->value('nombre');
        if ($usuario!=null) {
            Flash::error("El usuario ".$usuario." ya está creado");
            return redirect("/usuario/crear");
        }
        try {
            Usuario::create([
                'nombre' => $input['nombre'],
                'apellido' => $input['apellido'],
                'email' => $input['email'],
                'celular' => $input['celular'],
                'celularAlternativo' => $input['celularAlternativo'],
                'estado' => 1,
                'fechaNacimiento' => $input['fechaNacimiento'],
                'idGenero' => $input['genero'],
                'password' => Hash::make($input['password']),
            ]);
            Flash::success("Se ha creado éxitosamente");
            return redirect("/usuario");
        } catch (\Exception $e) {  
            Flash::error($e->getMessage());
            return redirect("/usuario/crear");
        }
    }

    public function editar($id)
    {
        $generos = DB::table('generos')->get()->where('id','>',1);
        $usuario = Usuario::find($id);        
        if ($usuario == null) {   
            Flash::error("No se encontró el usuario");      
            return redirect("/usuario");
        }
        return view("usuario.editar", compact("usuario","generos"));
    }

    public function ver($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario == null) {   
            Flash::error("No se encontró la usuario");      
            return redirect("/usuario");
        }
        $genero = Usuario::select('generos.nombre')->join("generos", "users.idGenero","generos.id")->value('nombre');
        return view("usuario.ver", compact("usuario","genero"));
    }

    public function modificar(Request $request)
    {
        $request->validate(Usuario::$rules);
        $id=$request->id;
        $input = $request->all();
        $usuario = usuario::select('*')->where('nombre', $request->nombre)->where('id','<>',$id)->value('nombre');
        if ($usuario!=null) {
            Flash::error("El usuario ".$usuario." ya está creado");
            return redirect("/usuario/editar/{$id}");
        }
        
        try {
            $usuario = Usuario::find($input["id"]);
            if ($usuario == null) {
                Flash::error("No se encontró el usuario");       
                return redirect("/usuario");
            }
            $usuario->update([
                'nombre' => $input['nombre'],
                'apellido' => $input['apellido'],
                'email' => $input['email'],
                'celular' => $input['celular'],
                'celularAlternativo' => $input['celularAlternativo'],
                'estado' => 1,
                'fechaNacimiento' => $input['fechaNacimiento'],
                'idGenero' => $input['genero'],
                'password' => Hash::make($input['password']),
            ]);
            Flash::success("Se ha modificado éxitosamente");
            return redirect("/usuario");
        } catch (\Exception $e) {  
            Flash::error($e->getMessage());
            return redirect("/usuario/editar/{$id}");
        }
    }

    public function modificarEstado($id, $estado)
    {
        $usuario = Usuario::find($id);
        if ($usuario == null) {        
            return redirect("/usuario");
        }
        try {
            $usuario->update(["estado" => $estado]);         
            return redirect("/usuario");
        } catch (\Exception $e) {
            Flash::error($e->getMessage());   
            return redirect("/usuario");
        }
    }
}
