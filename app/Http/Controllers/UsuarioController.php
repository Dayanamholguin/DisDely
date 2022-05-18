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

use Spatie\Permission\Models\Role;

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
            ->addColumn('acciones', function ($usuario) {
                $acciones = '<a class="btn btn-info btn-sm" href="/usuario/editar/' . $usuario->id . '" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i> Editar</a> ';
                $acciones .= '<a class="btn btn-secondary btn-sm" href="/usuario/ver/' . $usuario->id . '" data-toggle="tooltip" data-placement="top"><i class="fas fa-info-circle"></i> Ver</a> ';
                if ($usuario->estado == 1) {
                    $acciones .= '<a class="btn btn-danger btn-sm " href="/usuario/cambiar/estado/' . $usuario->id . '/0" data-toggle="tooltip" data-placement="top"><i class="bi bi-x-circle"></i> Inactivar</a>';
                } else {
                    $acciones .= '<a class="btn btn-success btn-sm " href="/usuario/cambiar/estado/' . $usuario->id . '/1" data-toggle="tooltip" data-placement="top"><i class="bi bi-check2"></i> Activar</a>';
                }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        $generos = DB::table('generos')->get()->where('id', '>', 1);
        return view('usuario.crear', compact("generos"));
    }

    public function guardar(Request $request)
    {
        $request->validate(Usuario::$rules);
        $input = $request->all();
        $usuario = Usuario::select('*')->where('nombre', $request->nombre)->value('nombre');
        if ($usuario != null) {
            Flash::error("El usuario " . $usuario . " ya está creado");
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
        $generos = DB::table('generos')->get()->where('id', '>', 1);
        $usuario = Usuario::find($id);
        if ($usuario == null) {
            Flash::error("No se encontró el usuario");
            return redirect("/usuario");
        }
        return view("usuario.editar", compact("usuario", "generos"));
    }

    public function ver($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario == null) {
            Flash::error("No se encontró el usuario");
            return redirect("/usuario");
        }
        $genero = Usuario::select('generos.nombre')->join("generos", "users.idGenero", "generos.id")->value('nombre');
        $rol = Role::select('name')->join("model_has_roles", "roles.id", "model_has_roles.role_id")->value('name');
        return view("usuario.ver", compact("usuario", "genero", "rol"));
    }

    public function modificar(Request $request, $id)
    {
        $usuario = Usuario::select("*")->where("email", $request->email)->first();
        if ($usuario != null) {
            $campos = [
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $usuario->id],
                'celular' => ['required', 'string', 'max:25'],
                'celularAlternativo' => ['string', 'max:25'],
                'fechaNacimiento' => ['required'],
                'genero' => ['required', 'exists:generos,id'],
            ];
            $this->validate($request, $campos);
        } else {
            $request->validate(Usuario::$rules);
        }
        // $input = request()->all();
        try {
            $usuario = Usuario::find($request["id"]);
            if ($usuario == null) {
                Flash::error("No se encontró el usuario");
                return redirect("/usuario");
            }
            $usuario->update([
                'nombre' => $request['nombre'],
                'apellido' => $request['apellido'],
                'email' => $request['email'],
                'celular' => $request['celular'],
                'celularAlternativo' => $request['celularAlternativo'],
                'fechaNacimiento' => $request['fechaNacimiento'],
                'idGenero' => $request['genero'],

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
