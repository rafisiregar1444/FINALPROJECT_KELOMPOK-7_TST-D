<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'user',
                'email' => 'user@example.com',
                'role' => 'user',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'Yayasan',
                'email' => 'bp@example.com',
                'role' => 'bp',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'Perguruan Tinggi',
                'email' => 'pt@example.com',
                'role' => 'pt',
                'password' => bcrypt('12345')
            ]
        ];
        foreach ($userData as $key => $val) {    
            User::create($val);
        }
    }
}