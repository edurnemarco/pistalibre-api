<?php

namespace App\Http\Controllers;

use App\Models\Convocatoria;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // GET /api/admin/pendientes
    public function pendientes()
    {
        $pendientes = Convocatoria::where('estado', 'pendiente')
            ->orderBy('created_at')
            ->get();

        return response()->json($pendientes);
    }

    // PUT /api/admin/convocatorias/{id}/aprobar
    public function aprobar($id)
    {
        $convocatoria = Convocatoria::findOrFail($id);
        $convocatoria->update(['estado' => 'publicada']);

        return response()->json(['message' => 'Convocatoria publicada']);
    }

    // PUT /api/admin/convocatorias/{id}/rechazar
    public function rechazar($id)
    {
        $convocatoria = Convocatoria::findOrFail($id);
        $convocatoria->update(['estado' => 'rechazada']);

        return response()->json(['message' => 'Convocatoria rechazada']);
    }

    // POST /api/admin/convocatorias
    public function store(Request $request)
    {
        $convocatoria = Convocatoria::create(
            array_merge($request->all(), [
                'estado' => 'publicada',
                'origen' => 'manual',
            ])
        );

        return response()->json($convocatoria, 201);
    }

    // GET /api/admin/usuarios
    public function usuarios()
    {
        return response()->json(User::all());
    }

    // PUT /api/admin/usuarios/{id}/desactivar
    public function desactivar($id)
    {
        $user = User::findOrFail($id);
        $user->update(['activo' => false]);

        return response()->json(['message' => 'Usuario desactivado']);
    }

    // POST /api/admin/scraping/importar
public function importar(Request $request)
{
    $data = $request->all();

    // Normalizar tipo — minúsculas, sin tildes y singular
    $tipoMap = [
        'ayudas'        => 'ayuda',
        'exposiciones'  => 'exposicion',
        'residencias'   => 'residencia',
        'becas'         => 'beca',
        'concursos'     => 'concurso',
        'convocatorias' => 'convocatoria',
        'premios'       => 'premio',
    ];

    $tipoRaw = strtolower($data['tipo'] ?? 'convocatoria');
    $tipoRaw = str_replace(
        ['á','é','í','ó','ú','ü','ñ'],
        ['a','e','i','o','u','u','n'],
        $tipoRaw
    );
    $data['tipo'] = $tipoMap[$tipoRaw] ?? $tipoRaw;

    // Crear o encontrar institución automáticamente
    $institucionId = null;
    if (!empty($data['institucion_nombre'])) {
        $webBase = null;
        if (!empty($data['url_original'])) {
            $parsed = parse_url($data['url_original']);
            $webBase = isset($parsed['scheme']) && isset($parsed['host'])
                ? $parsed['scheme'] . '://' . $parsed['host']
                : null;
        }

        $institucion = \App\Models\Institucion::firstOrCreate(
            ['nombre' => $data['institucion_nombre']],
            [
                'web'        => $webBase,
                'origen'     => 'scraping',
                'verificada' => false,
            ]
        );
        $institucionId = $institucion->id;
    }

    $convocatoria = Convocatoria::create(
        array_merge($data, [
            'estado'         => 'pendiente',
            'origen'         => 'scraping',
            'institucion_id' => $institucionId,
        ])
    );

    return response()->json($convocatoria, 201);
}
}