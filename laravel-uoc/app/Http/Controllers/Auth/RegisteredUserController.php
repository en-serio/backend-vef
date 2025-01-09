<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeN(Request $request)
    {
        Log::info($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'apellidoUno' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'rol' => 'required|string|in:Cliente',
        ], [
            'rol.in' => 'El campo rol debe ser Cliente',
            'email.unique' => 'El email ya está en uso',
            'email.email' => 'El email no es válido',
            'email.required' => 'El email es requerido',
            'name.required' => 'El nombre es requerido',
            'apellidoUno.required' => 'El primer apellido es requerido',
            'password.required' => 'La contraseña es requerida',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        if($request->rol == 'Corporativo'){
            $rol = 2;
        }else{
            $rol = 3;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $rol,
            'apellido1' => $request->apellidoUno,
            'apellido2' => $request->apellidoDos,
        ]);

        event(new Registered($user));
        Log::info('El nuevo usuario' . $user);

        session()->put('rol', $user->rol);
        session()->put('id', $user->id);

        Auth::login($user);

        return Redirect::route('dashboard');
    }
}
