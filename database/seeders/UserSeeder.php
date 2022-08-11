<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'first_name' => 'Marcel',
            'last_name' => 'Molina',
            'email' => 'marcel@gmail.com',
            'password' => Hash::make('12345678'),
            'card_id' => '22568963',
            'is_underage' => false,
            'phone' => '+34 654 789',
            'cell_phone' => '+34 654 789',
            'municipality_id' => 24,
            'admin' => true,
            'address' => 'Pueblo Nuevo, Calle de la Cruz, 1',
        ];

        User::firstOrCreate([
            'email' => $user['email']
        ], $user);
    }
}
