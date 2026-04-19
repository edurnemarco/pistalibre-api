<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // POST /api/register
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'tipo' => 'required|in:artista,institucion',
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo' => $request->tipo,
            'ciudad' => $request->ciudad,
            'region' => $request->region,
            'pais' => $request->pais ?? 'ES',
            'bio' => $request->bio,
            'activo' => true,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // POST /api/login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales no son correctas.'],
            ]);
        }

        if (!$user->activo) {
            throw ValidationException::withMessages([
                'email' => ['Esta cuenta ha sido desactivada.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    // POST /api/logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente.',
        ]);
    }

    // GET /api/me
    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    // PUT /api/perfil
public function updatePerfil(Request $request)
{
    $user = $request->user();
    $user->update($request->only([
        'nombre',
        'apellidos',
        'bio',
        'ciudad',
        'region',
        'pais',
        'web',
        'redes',
        'avatar_url',
        'disciplinas',
    ]));
    return response()->json($user);
}

// GET /api/usuarios/{id}
public function perfilPublico($id)
{
    $user = User::findOrFail($id);
    return response()->json([
        'id' => $user->id,
        'nombre' => $user->nombre,
        'apellidos' => $user->apellidos,
        'bio' => $user->bio,
        'ciudad' => $user->ciudad,
        'region' => $user->region,
        'disciplinas' => $user->disciplinas,
        'avatar_url' => $user->avatar_url,
        'web' => $user->web,
        'redes' => $user->redes,
    ]);
}
}