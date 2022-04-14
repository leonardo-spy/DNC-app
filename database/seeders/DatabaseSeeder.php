<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            'name' => 'leonardo',
            'email' => 'teste@teste.com',
            'email_verified_at' => null,
            'password' => '$2y$10$F8aObWeKqzeIQcxT6SdGmOrblT8sSLmW7hL4EegwfmIKagn5gcjwO', // senha
            'remember_token' => Str::random(10),
        ]);
        \App\Models\Funcionarios::factory(5)->create();
        \App\Models\Checkin::factory(3)->create();         
    }
}
