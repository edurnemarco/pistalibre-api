<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    // GET /api/favoritos
    public function index(Request $request)
    {
        $favoritos = Favorito::with('convocatoria')
            ->where('usuario_id', $request->user()->id)
            ->get();

        return response()->json($favoritos);
    }

    // POST /api/favoritos
   public function store(Request $request)
{
    $favorito = Favorito::create([
        'usuario_id' => $request->user()->id,
        'convocatoria_id' => $request->convocatoria_id,
    ]);

    return response()->json($favorito->load('convocatoria'), 201);
}

    // DELETE /api/favoritos/{id}
    public function destroy(Request $request, $id)
    {
        $favorito = Favorito::where('id', $id)
            ->where('usuario_id', $request->user()->id)
            ->firstOrFail();

        $favorito->delete();

        return response()->json(['message' => 'Favorito eliminado']);
    }
}