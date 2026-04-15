<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Convocatoria;
use App\Models\Institucion;

class ConvocatoriaSeeder extends Seeder
{
    public function run(): void
    {
        $trama = Institucion::where('nombre', 'Trama estudio')->first();
        $bilbaoarte = Institucion::where('nombre', 'BilbaoArte')->first();
        $tabakalera = Institucion::where('nombre', 'Tabakalera')->first();

        Convocatoria::create([
            'titulo' => 'Exposición colectiva Primavera 2026',
            'descripcion' => 'Convocatoria abierta para artistas emergentes residentes en Navarra o País Vasco. Se seleccionarán 8 propuestas.',
            'tipo' => 'convocatoria',
            'disciplinas' => ['pintura', 'escultura', 'fotografía', 'instalación'],
            'fecha_inicio' => '2026-03-15',
            'fecha_limite' => '2026-05-15',
            'dotacion' => null,
            'ciudad' => 'Pamplona',
            'region' => 'Navarra',
            'pais' => 'ES',
            'url_original' => 'https://tramaestudio.com/colectiva-primavera',
            'estado' => 'publicada',
            'origen' => 'institucion',
            'institucion_id' => $trama->id,
            'fuente_id' => null,
        ]);

        Convocatoria::create([
            'titulo' => 'Residencia artística BilbaoArte 2026',
            'descripcion' => 'Programa de residencias para artistas profesionales. Acceso a talleres especializados durante 3 meses.',
            'tipo' => 'residencia',
            'disciplinas' => ['pintura', 'escultura', 'grabado', 'videoarte'],
            'fecha_inicio' => '2026-04-01',
            'fecha_limite' => '2026-05-15',
            'dotacion' => null,
            'ciudad' => 'Bilbao',
            'region' => 'País Vasco',
            'pais' => 'ES',
            'url_original' => 'https://bilbaoarte.eus/residencias',
            'estado' => 'publicada',
            'origen' => 'scraping',
            'institucion_id' => $bilbaoarte->id,
            'fuente_id' => null,
        ]);

        Convocatoria::create([
            'titulo' => 'Open Call Tabakalera 2026',
            'descripcion' => 'Convocatoria internacional para proyectos de videoarte e instalación. Dotación de 5.000€ para el proyecto seleccionado.',
            'tipo' => 'concurso',
            'disciplinas' => ['videoarte', 'instalación'],
            'fecha_inicio' => '2026-03-01',
            'fecha_limite' => '2026-06-01',
            'dotacion' => 5000,
            'ciudad' => 'Donostia',
            'region' => 'País Vasco',
            'pais' => 'ES',
            'url_original' => 'https://tabakalera.eus/opencall',
            'estado' => 'publicada',
            'origen' => 'scraping',
            'institucion_id' => $tabakalera->id,
            'fuente_id' => null,
        ]);

        Convocatoria::create([
            'titulo' => 'Beca Fundación Caja Navarra 2026',
            'descripcion' => 'Beca para artistas navarros menores de 40 años. Disciplinas: fotografía y videoarte.',
            'tipo' => 'beca',
            'disciplinas' => ['fotografía', 'videoarte'],
            'fecha_inicio' => '2026-03-01',
            'fecha_limite' => '2026-04-22',
            'dotacion' => 3000,
            'ciudad' => 'Pamplona',
            'region' => 'Navarra',
            'pais' => 'ES',
            'url_original' => 'https://fundacioncan.es/beca-2026',
            'estado' => 'publicada',
            'origen' => 'manual',
            'institucion_id' => null,
            'fuente_id' => null,
        ]);
    }
}