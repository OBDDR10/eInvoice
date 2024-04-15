<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function __construct(
        protected Hasher $hash
    )
    {}

    public function run(): void
    {
        $users = [
            [
                'name' => 'test',
                'email' => 'user@test.com',
                'password' => $this->hash->make('password'),
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
