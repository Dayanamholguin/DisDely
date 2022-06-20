<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Principal;
use Laracasts\Flash\Flash;

class PrincipalController extends Controller
{
    public function editar()
    {
        $principal = Principal::find(1);        
        if ($principal == null) {   
            Flash("Error")->error()->important();      
            return back();
        }
        return view("principal.editar", compact("principal"));
    }

    public function modificar(Request $request)
    {
        if ($request->id <> 1) {
            Flash("No se puede editar la configuración de la página")->error()->important();
            return back();
        }
        // dd($request->foto);
        $request->validate(Principal::$rules);
        $id = $request->id;
        $input = $request->all();
        try {
            $principal = Principal::find($id);
            $principal->update([
                "quienes" => ucfirst($input["quienes"]),
                "productos" => ucfirst($input["productos"]),
                "ubicacion" => $input["ubicacion"],
                "email" => $input["email"],
                "celular" => $input["celular"],
                "celular2" => $input["celular2"],
                "instagram" => $input["instagram"],
            ]);
            if ($request->hasFile('foto')) {
                $archivoFoto = $request->file('foto');
                $nombreFoto = time() . $archivoFoto->getClientOriginalName();
                $archivoFoto->move(public_path() . '/imagenesPrincipales/', $nombreFoto);
                $principal->foto = $nombreFoto;
                $principal->update(['foto' => $nombreFoto]);
            }
            if ($request->hasFile('foto2')) {
                $archivoFoto = $request->file('foto2');
                $nombreFoto = time() . $archivoFoto->getClientOriginalName();
                $archivoFoto->move(public_path() . '/imagenesPrincipales/', $nombreFoto);
                $principal->foto2 = $nombreFoto;
                $principal->update(['foto2' => $nombreFoto]);
            }
            Flash("Se ha modificado éxitosamente")->success()->important();
            return back();
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return back();
        }
    }
    public function restablecer()
    {
        try {
            $principal = Principal::find(1);
            $principal->update([
                'quienes' => 'Somos un negocio dedicado a la producción de productos de pastelería de alta calidad y sabor; ubicada en Bello, Las Vegas. Ofrecemos a nuestros clientes productos de la mejor calidad y frescura. Contamos con una amplia gama de variedades en pan, repostería y pasteles de línea para todo tipo de gusto.',
                'productos' => 'Acá podrás ver los últimos productos registrados en el sistema, tenemos más productos para mostrarte dentro del aplicativo',
                'ubicacion' => 'Av 67 #67 - 78 | Bello, Las Vegas',
                'email' => 'disdely.dulcencanto@gmail.com',
                'celular' => '3127018618',
                'celular2' => '3106368657',
                'foto' => 'harinas.jpg',
                'foto2' => 'preparar.png',
                'instagram' => 'https://www.instagram.com/dulce_encanto_20205/'
            ]);
            Flash("Se ha restablecido éxitosamente")->success()->important();
            return back();
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return back();
        }
    }
}
