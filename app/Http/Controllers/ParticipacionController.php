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
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($participaciones);
    }

    // POST /api/participaciones
    public function store(Request $request)
    {
        $participacion = Participacion::create([
            'usuario_id' => $request->user()->id,
            'convocatoria_id' => $request->convocatoria_id,
            'convocatoria_nombre' => $request->convocatoria_nombre,
            'institucion_nombre' => $request->institucion_nombre,
            'lugar' => $request->lugar,
            'resultado' => $request->resultado,
            'nombre_proyecto' => $request->nombre_proyecto,
            'descripcion_proyecto' => $request->descripcion_proyecto,
            'imagen_url' => $request->imagen_url,
            'imagenes' => $request->imagenes,
            'enlaces' => $request->enlaces,
            'año' => $request->año,
        ]);

        return response()->json($participacion->load('convocatoria'), 201);
    }

    // PUT /api/participaciones/{id}
    public function update(Request $request, $id)
    {
        $participacion = Participacion::where('id', $id)
            ->where('usuario_id', $request->user()->id)
            ->firstOrFail();
        $participacion->update([
            'institucion_nombre' => $request->institucion_nombre,
            'convocatoria_id' => $request->convocatoria_id,
            'convocatoria_nombre' => $request->convocatoria_nombre,
            'lugar' => $request->lugar,
            'resultado' => $request->resultado,
            'nombre_proyecto' => $request->nombre_proyecto,
            'descripcion_proyecto' => $request->descripcion_proyecto,
            'imagen_url' => $request->imagen_url,
            'imagenes' => $request->imagenes,
            'enlaces' => $request->enlaces,
            'año' => $request->input('año'),
        ]);

        return response()->json($participacion->load('convocatoria'));
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

    public function indexPublico($id)
{
    $participaciones = Participacion::with('convocatoria:id,titulo')
        ->where('usuario_id', $id)
        ->orderBy('año', 'desc')
        ->get();

    return response()->json($participaciones);
}
}