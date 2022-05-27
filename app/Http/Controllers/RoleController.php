<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DataTables;
use Flash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        return view('rol.index');
    }

    public function listar(Request $request)
    {
        $roles = Role::all()->where('id', '>', 0);
        return DataTables::of($roles)
            ->editColumn("estado", function ($rol) {
                return $rol->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($rol) {
                $acciones = '<a class="btn btn-info btn-sm"  href="/rol/editar/' . $rol->id . '" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i> Editar</a> ';
                if ($rol->estado == 1) {
                    $acciones .= '<a class="btn btn-danger btn-sm"  href="/rol/cambiar/estado/' . $rol->id . '/0" data-toggle="tooltip" data-placement="top"><i class="bi bi-x-circle"></i> Inactivar</a>';
                } else {
                    $acciones .= '<a class="btn btn-success btn-sm" href="/rol/cambiar/estado/' . $rol->id . '/1" data-toggle="tooltip" data-placement="top"><i class="bi bi-check-circle"></i> Activar</a>';
                }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        $permissions = Permission::all()->where('id', '>', 0);
        return view('rol.crear', compact('permissions'));
    }

    public function guardar(Request $request)
    {
        $pattern = "[a-zA-Z]+";
        $input = $request->all();
        $rol = Role::select('*')->where('name', $request->name)->value('name');
        if ($rol != null) {
            Flash::error("El rol " . $rol . " ya está creado");
            return back();
        }
        $permisos = Permission::all();
        if ($request->permissions == null) {
            Flash::error("Debe seleccionar los permisos que quiera asociar al rol");
            return back();
        } elseif ($request->name == null) {
            Flash::error("Debe llenar el campo de nombre que desea ponerle al rol");
            return back();
        } 
        // elseif ($request->name != $pattern) {
        //     Flash::error("Para el campo nombre, solo se admiten letras");
        //     return back();
        // } 
        else {
            foreach ($permisos as $permiso) {
                foreach ($request->permissions as $key => $value) {
                    if (in_array($value[$key], $request->permissions)) {
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
                    } else {
                        Flash::error("No se encuentra ese valor del rol");
                        return back();
                    }
                }
            }
        } 
    }

    public function editar($id)
    {
        $permisos = Permission::all();
        $rol = Role::find($id);
        // SELECT role_has_permissions.permission_id, roles.name FROM `role_has_permissions` 
        // join roles on role_has_permissions.role_id=roles.id 
        // where roles.id=3             
        if ($rol == null) {
            Flash::error("No se encontró el rol");
            return redirect("/rol");
        }
        $rolPermisos = DB::table('role_has_permissions')->where('role_id', $rol->id)->get();
        return view("rol.editar", compact("rol", "permisos", "rolPermisos"));
    }

    public function modificar(Request $request)
    {
        $pattern = "[a-zA-Z]+";
        // $request->validate(Role::$rules);
        $input = $request->all();
        $id = $request->id;
        $rol = Role::select('*')->where('name', $request->name)->where('id', '<>', $id)->value('name');
        if ($rol != null) {
            Flash::error("El rol " . $rol . " ya está creado");
            return redirect("/rol/editar/$id");
        } else if ($request->name == null) {
            Flash::error("El campo nombre es requerido");
            return redirect("/rol/editar/$id");
        } else if ($request->permisos == null) {
            Flash::error("Debe seleccionar los permisos que quiera asociar al rol");
            return redirect("/rol/editar/$id");
        } else if ($request->name != $pattern) {
            Flash::error("Para el campo nombre, solo se admiten letras");
            return redirect("/rol/editar/$id");
        }
        $permisos = Permission::all();
        foreach ($permisos as $permiso) {
            foreach ($request->permisos as $key => $value) {
                if ($value[$key] == $permiso->id) {
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
                } else {
                    Flash::error("No se encuentra ese valor del rol");
                    return redirect("/rol/editar/$id");
                }
            }
        }
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
