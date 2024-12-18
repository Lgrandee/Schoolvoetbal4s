<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class RefereeSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Referee User',
            'email' => 'referee@example.com',
            'password' => bcrypt('password123'), // Use a secure password
            'is_admin' => false,
            'is_referee' => true,
        ]);
    }
}
