<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    // GET /api/alertas
    public function index(Request $request)
    {
        $alertas = Alerta::with('convocatoria')
            ->where('usuario_id', $request->user()->id)
            ->get();

        return response()->json($alertas);
    }

    // POST /api/alertas
    public function store(Request $request)
    {
        $alerta = Alerta::create([
            'usuario_id' => $request->user()->id,
            'convocatoria_id' => $request->convocatoria_id,
            'dias_antes' => $request->dias_antes ?? 7,
            'notificado_email' => false,
        ]);

        return response()->json($alerta, 201);
    }

    // DELETE /api/alertas/{id}
    public function destroy(Request $request, $id)
    {
        $alerta = Alerta::where('id', $id)
            ->where('usuario_id', $request->user()->id)
            ->firstOrFail();

        $alerta->delete();

        return response()->json(['message' => 'Alerta eliminada']);
    }

    public function destroyByConvocatoria(Request $request, $convocatoriaId)
{
    Alerta::where('usuario_id', $request->user()->id)
        ->where('convocatoria_id', $convocatoriaId)
        ->delete();

    return response()->json(['message' => 'Alertas eliminadas']);
}
}