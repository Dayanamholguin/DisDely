<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DataTables;
use Flash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\role_has_permissions;

class RoleController extends Controller
{
    public function index()
    {
        return view('rol.index');
    }

    public function listar(Request $request)
    {
        $roles = Role::all()->where('id','>',0);
        return DataTables::of($roles)
            ->editColumn("estado", function ($rol) {
                return $rol->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($rol) {
                $acciones = '<a class="btn btn-primary btn-sm" href="/rol/editar/' . $rol->id . '"><i class="fas fa-edit"></i></a> ';
                $acciones .= '<a class="btn btn-primary btn-sm" href="/rol/ver/' . $rol->id . '"><i class="fas fa-info-circle"></i></a> ';
                if ($rol->estado == 1) {
                    $acciones .= '<a class="btn btn-danger btn-sm" href="/rol/cambiar/estado/' . $rol->id . '/0" data-toggle="tooltip" data-placement="top" title="Inactivar"><i class="far fa-eye-slash"></i></a>';
                } else {
                    $acciones .= '<a class="btn btn-success btn-sm" href="/rol/cambiar/estado/' . $rol->id . '/1" data-toggle="tooltip" data-placement="top" title="Activar"><i class="far fa-eye"></i></a>';
                }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        $permissions = Permission::all()->where('id','>',0);
        return view('rol.crear', compact('permissions'));
    }

    public function guardar(Request $request)
    {
        
        $request->validate(Role::$rules);
        //dd($request);
        $input = $request->all();
        $rol = Role::select('*')->where('name', $request->name)->value('name');
        if ($rol!=null) {
            Flash::error("El rol ".$rol." ya está creado");
            return redirect("/rol");
        }
        try {
            $rol = Role::create([
                "name" => $input["name"],
                "estado" => 1,
            ]);
            $rol->permissions()->sync($request->permissions);
            Flash::success("Se ha creado éxitosamente");
            return redirect("/rol");
        } catch (\Exception $e) {  
            Flash::error($e->getMessage());
            return redirect("/rol");
        }
    }

    public function editar($id)
    {
        $permisos = Permission::all();
        $rol = Role::find($id);
        $rolPermisos = DB::table('role_has_permissions')->where('role_id', $rol->id)->get();
                
        // SELECT role_has_permissions.permission_id, roles.name FROM `role_has_permissions` 
        // join roles on role_has_permissions.role_id=roles.id 
        // where roles.id=3 
                
        if ($rol == null) {    
            Flash::error("No se encontró el rol");     
            return redirect("/rol");
        }        
        return view("rol.editar", compact("rol", "permisos", "rolPermisos"));
    }

    public function modificar(Request $request)
    {
        
        $request->validate(Role::$rules);
        
        $input = $request->all();

        $id=$request->id;
        $rol = Role::select('*')->where('name',$request->name)->where('id','<>',$id)->value('name');
        if ($rol!=null) {
            Flash::error("El rol ".$rol." ya está creado");
            return redirect("/rol/editar/$id");
        }


        try {
            $rol = Role::find($input["id"]);
            if ($rol == null) {            
                return redirect("/rol");
            }
            $rol->update([
                "name" => $input["name"]
            ]);
            $rol->permissions()->sync($request->permisos);
            Flash::success("Se ha modificado éxitosamente");
            return redirect("/rol");
        } catch (\Exception $e) {   
            Flash::error($e->getMessage());
            return redirect("/rol");
        }
    }

    public function ver($id)
    {
        $roles = Role::find($id);
        if ($roles == null) {   
            Flash::error("No se encontró el rol");      
            return redirect("/rol");
        }
        // SELECT permissions.description FROM permissions JOIN role_has_permissions 
        // on permissions.id=role_has_permissions.permission_id JOIN roles 
        // on role_has_permissions.role_id=roles.id WHERE roles.id=3;

        $rolPermisos = Permission::select('permissions.description')
        ->join("role_has_permissions", "permissions.id", "role_has_permissions.permission_id")
        ->join("roles", "role_has_permissions.role_id", "roles.id")
        ->where("roles.id", $id)
        ->get();
        //dd($rolPermisos);
        return view("rol.ver", compact("rolPermisos", "roles"));
    }

    public function modificarEstado($id, $estado)
    {
        $rol = Role::find($id);
        if ($rol == null) {        
            return redirect("/rol");
        }
        try {
            $rol->update(["estado" => $estado]);         
            return redirect("/rol");
        } catch (\Exception $e) {       
            return redirect("/rol");
        }
    }
}

