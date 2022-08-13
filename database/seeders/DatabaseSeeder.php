<?php

namespace Database\Seeders;

use App\Models\Disease;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MunicipalitySeeder::class);
        $this->call(UserSeeder::class);

        Notification::factory(35)->create();

        User::factory()
            ->count(60)
            ->has(Disease::factory()->count(1))
            ->create();
    }
}
