<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Identifiants lus depuis .env (ne jamais les écrire en dur dans le code)
        $email = env('ADMIN_EMAIL', 'admin@ecatic.local');
        $password = env('ADMIN_PASSWORD');

        if (! $password) {
            $this->command?->warn('ADMIN_PASSWORD absent du .env : compte admin non créé.');
            return;
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('ADMIN_NAME', 'Administrateur ECATIC'),
                'password' => Hash::make($password),
                'is_admin' => true,
            ]
        );
    }
}
