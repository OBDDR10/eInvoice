<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'username' => 'tech',
                'name' => 'tech1',
                'email' => 'tech@gmail.com',
                'password' => Hash::make('123123123'),
                'status' => Admin::active,
                'role_id' => 1,
            ],
            [
                'username' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123123123'),
                'status' => Admin::active,
                'role_id' => 2,
            ],
        ];

        foreach ($data as $d) {
            Admin::create($d);
        }
    }
}
