<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;

class InstitucionController extends Controller
{
    // GET /api/instituciones
    public function index()
    {
        return response()->json(Institucion::all());
    }

    // GET /api/instituciones/{id}
    public function show($id)
    {
        $institucion = Institucion::with('convocatorias')->findOrFail($id);
        return response()->json($institucion);
    }

    // PUT /api/instituciones/{id}
    public function update(Request $request, $id)
    {
        $institucion = Institucion::findOrFail($id);
        $institucion->update($request->all());
        return response()->json($institucion);
    }

    // GET /api/mi-institucion
    public function miInstitucion(Request $request)
    {
        $institucion = Institucion::with('convocatorias')
            ->where('usuario_id', $request->user()->id)
            ->firstOrFail();

        return response()->json($institucion);
    }

    // PUT /api/mi-institucion
    public function updateMiInstitucion(Request $request)
    {
        $institucion = Institucion::where('usuario_id', $request->user()->id)
            ->firstOrFail();

        $institucion->update($request->only([
            'nombre',
            'descripcion',
            'linea_curatorial',
            'ciudad',
            'region',
            'pais',
            'web',
            'avatar_url',
        ]));

        return response()->json($institucion);
    }
}