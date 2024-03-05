<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData =[
            [
                'name' => 'admin',
                'email' => 'admin@example',
                'akses' => 'admin',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'peminjam',
                'email' => 'peminjam@example',
                'akses' => 'peminjam',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'operator',
                'email' => 'operator@example',
                'akses' => 'operator',
                'password' => bcrypt('password'),
            ]
        ];

        foreach ($userData as $key => $value) {
            User::create($value);
        };
    }
}
