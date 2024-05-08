<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            'name' => 'Dareus Liew',
            'email' => 'liew@oceantech.asia',
            'password' => bcrypt('Ocean1234@@'),
            'role' => 'user',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('users')->insert([
            'name' => 'Dareus Liew',
            'email' => 'dareusliew1998@gmail.com',
            'password' => bcrypt('Ocean1234@@'),
            'role' => 'admin',
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
