<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /*
        Vendor/laravel/ui/auth-backend/AuthenticatesUsers
        Copiar esto en AuthenticatesUsers en la función login antes del $this->validateLogin($request);
        
        $usuario = Usuario::select()->where('email', $request["email"])->first();
        if($usuario == null){
            Flash("No se encontró el usuario con ese gmail, intente nuevamente")->error()->warning();
            return redirect("/login");
        }
        if ($usuario->estado != 1) {
            Flash("No puedes iniciar sesión, estás en estado deshabilitado")->error()->warning();
            return redirect("/login");
        }
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
