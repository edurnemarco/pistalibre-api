<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institucion;
use App\Models\User;

class InstitucionSeeder extends Seeder
{
    public function run(): void
    {
        $usuarioTrama = User::where('email', 'trama@pistalibre.com')->first();

        Institucion::create([
            'usuario_id' => $usuarioTrama->id,
            'nombre' => 'Trama estudio',
            'descripcion' => 'Espacio creativo autogestionado en Pamplona. Organizamos talleres, exposiciones y residencias para artistas emergentes del ámbito vasco y navarro.',
            'linea_curatorial' => 'Nos interesa el arte que dialoga con el territorio, la comunidad y los procesos colaborativos. Trabajamos especialmente con artistas emergentes de Navarra y Euskal Herria.',
            'ciudad' => 'Pamplona',
            'region' => 'Navarra',
            'pais' => 'ES',
            'web' => 'https://tramaestudio.com',
            'origen' => 'registro',
            'verificada' => true,
        ]);

        Institucion::create([
            'usuario_id' => null,
            'nombre' => 'BilbaoArte',
            'descripcion' => 'Centro de producción y difusión de arte contemporáneo de Bilbao.',
            'linea_curatorial' => 'Apoyo a la creación artística contemporánea con especial atención a artistas emergentes del País Vasco.',
            'ciudad' => 'Bilbao',
            'region' => 'País Vasco',
            'pais' => 'ES',
            'web' => 'https://bilbaoarte.eus',
            'origen' => 'scraping',
            'verificada' => false,
        ]);

        Institucion::create([
            'usuario_id' => null,
            'nombre' => 'Tabakalera',
            'descripcion' => 'Centro Internacional de Cultura Contemporánea de Donostia.',
            'linea_curatorial' => 'Investigación y producción artística contemporánea con vocación internacional.',
            'ciudad' => 'Donostia',
            'region' => 'País Vasco',
            'pais' => 'ES',
            'web' => 'https://tabakalera.eus',
            'origen' => 'scraping',
            'verificada' => false,
        ]);
    }
}