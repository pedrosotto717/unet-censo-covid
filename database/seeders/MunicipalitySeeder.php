<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $municipalities = [
            ['name' => 'Antonio Rómulo Costa'],
            ['name' => 'Ayacucho'],
            ['name' => 'Bolívar'],
            ['name' => 'Cárdenas'],
            ['name' => 'Córdoba'],
            ['name' => 'Fernández Feo'],
            ['name' => 'Francisco de Miranda'],
            ['name' => 'García de Hevia'],
            ['name' => 'Guásimos'],
            ['name' => 'Independencia'],
            ['name' => 'Jáuregui'],
            ['name' => 'José María Vargas'],
            ['name' => 'Junín'],
            ['name' => 'Libertad'],
            ['name' => 'Libertador'],
            ['name' => 'Lobatera'],
            ['name' => 'Michelena'],
            ['name' => 'Panamericano'],
            ['name' => 'Pedro María Ureña'],
            ['name' => 'Rafael Urdaneta'],
            ['name' => 'Samuel Dario Maldonado'],
            ['name' => 'San Cristóbal'],
            ['name' => 'San Judas Tadeo'],
            ['name' => 'Seboruco'],
            ['name' => 'Simón Rodríguez'],
            ['name' => 'Sucre'],
            ['name' => 'Torbes'],
            ['name' => 'Uribante'],
        ];

        collect($municipalities)->each(function ($municipality) {
            Municipality::firstOrCreate($municipality, $municipality);
        });
    }
}
