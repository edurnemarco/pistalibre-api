<?php

namespace App\Http\Controllers;

use App\Models\Convocatoria;
use Illuminate\Http\Request;
use App\Models\Participacion;

class ConvocatoriaController extends Controller
{
    // GET /api/convocatorias
    public function index(Request $request)
    {
        $query = Convocatoria::with('institucion')->where('estado', 'publicada');

        if ($request->tipo) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->region) {
            $query->where('region', $request->region);
        }

        if ($request->ciudad) {
            $query->where('ciudad', $request->ciudad);
        }

        return response()->json($query->orderBy('fecha_limite')->get());
    }

    // GET /api/convocatorias/{id}
    public function show($id)
    {
        $convocatoria = Convocatoria::with('institucion')->findOrFail($id);
        return response()->json($convocatoria);
    }

    // POST /api/convocatorias
    public function store(Request $request)
{
    try {
        $convocatoria = Convocatoria::create($request->all());
        return response()->json($convocatoria, 201);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function detalle($id)
{
    $convocatoria = Convocatoria::with(['institucion', 'participaciones.usuario:id,nombre,apellidos,avatar_url'])
        ->findOrFail($id);
    return response()->json($convocatoria);
}

    // PUT /api/convocatorias/{id}
    public function update(Request $request, $id)
    {
        $convocatoria = Convocatoria::findOrFail($id);
        $convocatoria->update($request->all());
        return response()->json($convocatoria);
    }

    // DELETE /api/convocatorias/{id}
    public function destroy($id)
    {
        Convocatoria::findOrFail($id)->delete();
        return response()->json(['message' => 'Eliminada correctamente']);
    }

    // GET /api/convocatorias/{id}/participantes
public function participantes($id)
{
    Convocatoria::findOrFail($id);

    $participaciones = Participacion::with('usuario:id,nombre,apellidos,avatar_url')
        ->where('convocatoria_id', $id)
        ->select('id', 'usuario_id', 'año', 'resultado', 'lugar', 'nombre_proyecto')
        ->orderBy('año', 'desc')
        ->orderBy('lugar', 'asc')
        ->get()
        ->map(function ($p) {
            return [
                'id'              => $p->id,
                'año'             => $p->año,
                'resultado'       => $p->resultado,
                'lugar'           => $p->lugar,
                'nombre_proyecto' => $p->nombre_proyecto,
                'usuario'         => $p->usuario ? [
                    'id'         => $p->usuario->id,
                    'nombre'     => $p->usuario->nombre,
                    'apellidos'  => $p->usuario->apellidos,
                    'avatar_url' => $p->usuario->avatar_url,
                ] : null,
            ];
        });

    return response()->json($participaciones);
}
}