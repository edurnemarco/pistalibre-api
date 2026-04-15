<?php

namespace App\Http\Controllers;

use App\Models\Convocatoria;
use Illuminate\Http\Request;

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
        $convocatoria = Convocatoria::create($request->all());
        return response()->json($convocatoria, 201);
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
}