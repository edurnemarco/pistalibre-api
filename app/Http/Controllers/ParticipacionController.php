<?php

namespace App\Http\Controllers;

use App\Models\Participacion;
use Illuminate\Http\Request;

class ParticipacionController extends Controller
{
    // GET /api/participaciones
    public function index(Request $request)
    {
        $participaciones = Participacion::with('convocatoria')
            ->where('usuario_id', $request->user()->id)
            ->get();

        return response()->json($participaciones);
    }

    // POST /api/participaciones
    public function store(Request $request)
    {
        $participacion = Participacion::create([
            'usuario_id' => $request->user()->id,
            'convocatoria_id' => $request->convocatoria_id,
            'resultado' => $request->resultado ?? 'pendiente',
            'nombre_proyecto' => $request->nombre_proyecto,
            'descripcion_proyecto' => $request->descripcion_proyecto,
            'imagen_url' => $request->imagen_url,
            'año' => $request->año,
        ]);

        return response()->json($participacion, 201);
    }

    // PUT /api/participaciones/{id}
    public function update(Request $request, $id)
    {
        $participacion = Participacion::where('id', $id)
            ->where('usuario_id', $request->user()->id)
            ->firstOrFail();

        $participacion->update($request->all());

        return response()->json($participacion);
    }

    // DELETE /api/participaciones/{id}
    public function destroy(Request $request, $id)
    {
        $participacion = Participacion::where('id', $id)
            ->where('usuario_id', $request->user()->id)
            ->firstOrFail();

        $participacion->delete();

        return response()->json(['message' => 'Participación eliminada']);
    }
}