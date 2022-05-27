<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Flash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class PerfilController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('password.confirm')->only('modificar');
    // }
    public function index($id)
    {
        $generos = DB::table('generos')->get()->where('id','>',1);
        $usuario = Usuario::find($id);
        if ($usuario == null) {   
            Flash::error("Perfil no encontrado");      
            return redirect("/home");
        }
        return view("perfil.ver", compact("usuario","generos"));
    }
    public function cambiar($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario == null) {   
            Flash::error("Perfil no encontrado");      
            return redirect("/home");
        }
        return view("perfil.cambiar", compact("usuario"));
    }
    public function cambiarFoto($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario == null) {   
            Flash::error("Perfil no encontrado");      
            return redirect("/home");
        }
        return view("perfil.cambiarFoto", compact("usuario"));
    }

    public function recibirFoto(Request $request, $id)
    {    
        // dd($request->imagen);
        $usuario = Usuario::find($id);
        if ($usuario == null) {   
            Flash::error("Perfil no encontrado");      
            return redirect("/perfil/{$request->id}");
        }        
            $imagen = $request->imagen;
            $mi_imagen = public_path() . '/img/' . $imagen;
            if (is_file($mi_imagen)==false) {
                Flash::error("Imagen no encontrada");      
                return redirect("/perfil/cambiarFoto/{$request->id}");
            }
            $usuario->update([
                "foto"=>$imagen,
            ]);
            Flash::success("Se ha modificado la foto de perfil correctamente");
            return redirect("/perfil/{$request->id}");
            
    }

    public function cambiarContrasena(Request $request, $id)
    {
        $usuario = Usuario::find($id);
            // dd($request->oldPassword);
            if ($usuario == null) {
                Flash::error("No se encontró el usuario");       
                return back();
            }
            //$request->validate(Usuario::$rules);
        if($request->oldPassword!="" && $request->password!="" && $request->password_confirmation!=""){   
            if (strlen($request->password)>=8) {
                if ($request->password==$request->password_confirmation) {
                    if (Hash::check($request->oldPassword, $usuario->password) || ($request->oldPassword ==$usuario->password) ) {
                        $usuario->update([
                            'password' => Hash::make($request->password)
                        ]);
                        Flash::success("Se ha modificado éxitosamente");
                        return back();
                    } else {
                        Flash::error("No coincide su contraseña actual, por favor intente nuevamente");       
                        return back();
                    }                    
                } else {
                    Flash::error("No coinciden las nuevas contraseñas, intente nuevamente");       
                    return back();
                }                
            }else {
                Flash::error("Deben ser mayor a 8 digitos");       
                return back();
            }
        }else {
            Flash::error("Por favor, complete todos los campos");       
            return back();
        }
    }
    
    public function modificar(Request $request, $id)
    {
        $correo = Usuario::select('*')->where('email',$request->email)->where('id','<>',$id)->value('email');
        if ($correo!=null) {
            Flash::error("El correo ".$correo." ya está creado, intente con otro correo nuevamente.");
            return redirect("/perfil/{$request->id}");
        }
        $usuario = Usuario::select("*")->where("email", $request->email)->first();
        if($usuario != null){
            $campos = [
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$usuario->id ],
                'celular' => ['required', 'numeric'],
                'celularAlternativo' => ['numeric'],
                'genero' => ['required', 'exists:generos,id'],
            ];
            $this->validate($request, $campos);
        }else{
            $e = Usuario::find($request->email);
            if ($e) {
                Flash::error("Ese correo ya está en uso");       
                return back();
            }
            $campos = [
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'],
                'celular' => ['required', 'numeric'],
                'celularAlternativo' => ['numeric'],
                'genero' => ['required', 'exists:generos,id'],
            ];
            $this->validate($request, $campos);
            // $request->validate(Usuario::$rules);
        }
        // $input = request()->all();
        try {
            $usuario = Usuario::find($request["id"]);
            // dd($usuario);
            if ($usuario == null) {
                Flash::error("No se encontró el usuario");       
                return redirect("/perfil/{$request->id}");
            }
            if($request->celular==$request->celularAlternativo){
                Flash::error("No se puede colocar los celulares iguales, ingrese uno diferente, por favor.");       
                return redirect("/perfil/{$request->id}");
            }
            
            $usuario->update([
                'nombre' => $request['nombre'],
                'apellido' => $request['apellido'],
                'email' => $request['email'],
                'celular' => $request['celular'],
                'celularAlternativo' => $request['celularAlternativo'],
                'idGenero' => $request['genero'],
                
            ]);
            Flash::success("Se ha modificado éxitosamente");
            return redirect("/perfil/{$request->id}");
        } catch (\Exception $e) {  
            Flash::error($e->getMessage());
            return redirect("/perfil/{$request->id}");
        }
    }
}
