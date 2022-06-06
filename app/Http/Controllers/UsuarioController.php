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
//use Laracasts\Flash\Flash as Flash;
use PhpParser\Node\Stmt\Catch_;
use App\Models\User;
use Laracasts\Flash\Flash as FlashFlash;
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
            ->where("users.id", ">", 1)
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
                    $acciones .= '<a class="btn btn-success btn-sm " href="/usuario/cambiar/estado/' . $usuario->id . '/1" data-toggle="tooltip" data-placement="top"><i class="bi bi-check-circle"></i> Activar</a>';
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
        $correo = Usuario::find($request->email);
        if ($correo != null) {
            Flash::error("El correo " . $correo . " ya está en uso");
            return redirect("/usuario/crear");
        }
        if($request->celular==$request->celularAlternativo){
            Flash::error("No se puede colocar los celulares iguales, ingrese uno diferente, por favor.");       
            return redirect("/usuario/crear");
        }
        // else if ($request->nombre || $request->apellido != $pattern) {
        //     Flash::error("El campo nombre y apellido solo admiten letras");
        //     return back();
        // }
        try {
            if ($input['genero']==3) {
                $foto = 'undraw_profile_3.svg';
            }else{
                $foto = 'undraw_profile_2.svg';
            }
            // dd($foto);
            Usuario::create([
                'nombre' => $input['nombre'],
                'apellido' => $input['apellido'],
                'email' => $input['email'],
                'celular' => $input['celular'],
                'celularAlternativo' => $input['celularAlternativo'],
                'estado' => 1,
                'idGenero' => $input['genero'],
                'password' => Hash::make("dulce_ncan4*:"),
                'foto' => $foto,
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
        $roles = Role::all()->where('name', '<>', 'Admin');
        $generos = DB::table('generos')->get()->where('id', '>', 1);
        $usuario = Usuario::find($id);
        
        if ($usuario == null || $id == 1) {
            Flash::error("No se encontró el usuario");
            return redirect("/usuario");
        }
        // SELECT roles.name FROM `model_has_roles`
        // join roles on roles.id=model_has_roles.role_id
        // JOIN users on users.id=model_has_roles.model_id
        // where users.id=3;
        $consulta = Role::select('roles.id')
        ->join("model_has_roles", "roles.id", "model_has_roles.role_id")
        ->join("users", "users.id", "model_has_roles.model_id")
        ->where("users.id", $id)
        ->value("id");
        // dd($consulta);
        return view("usuario.editar", compact("usuario", "generos", "roles", "consulta"));
    }

    public function ver($id)
    {
        $usuario = Usuario::find($id);
        // dd($usuario);
        if ($usuario == null || $id == 1) {
            Flash::error("No se encontró el usuario");
            return redirect("/usuario");
        }
        $genero = Usuario::select('generos.nombre')->join("generos", "users.idGenero", "generos.id")->value('nombre');
        $rol = Role::select('name')->join("model_has_roles", "roles.id", "model_has_roles.role_id")->value('name');
        return view("usuario.ver", compact("usuario", "genero", "rol"));
    }

    public function modificar(Request $request, $id)
    {   
        if($id == 1)
        {
            Flash("No se puede modificar este usuario")->error()->important();
            return redirect("/usuario");
        }
        $correo = Usuario::select('*')->where('email',$request->email)->where('id','<>',$id)->value('email');
        if ($correo!=null) {
            Flash::error("El correo ".$correo." ya está creado, intente con otro correo nuevamente.");
            return redirect("/usuario/editar/{$id}");
        }
        $usuario = Usuario::select("*")->where("email", $request->email)->first();
        if ($usuario != null) {
            $campos = [
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $usuario->id],
                'celular' => ['required', 'numeric'],
                'celularAlternativo' => ['required', 'numeric'],
                'genero' => ['required', 'exists:generos,id'],
            ];
            $this->validate($request, $campos);
        } else {
            $campos = [
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'celular' => ['required', 'numeric'],
                'celularAlternativo' => ['required', 'numeric'],
                'genero' => ['required', 'exists:generos,id'],
            ];
            $this->validate($request, $campos);
        }
        // $input = request()->all();
        try {
            $usuario = Usuario::find($request["id"]);
            if ($usuario == null) {
                Flash::error("No se encontró el usuario");
                return redirect("/usuario");
            }
            if($request->celular==$request->celularAlternativo){
                Flash::error("No se puede colocar los celulares iguales, ingrese uno diferente, por favor.");       
                return redirect("/usuario/editar/{$id}");
            }
            $usuario->update([
                'nombre' => $request['nombre'],
                'apellido' => $request['apellido'],
                'email' => $request['email'],
                'celular' => $request['celular'],
                'celularAlternativo' => $request['celularAlternativo'],
                'idGenero' => $request['genero'],
            ]); 
            $usuarioRol = User::find($id);
            $usuarioRol->roles()->sync($request->roles);        
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
        if ($usuario == null || $id == 1) {
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
