<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Admin',
            'email' => 'admin',
            'password' => Hash::make('admin'),
            'no_telp' => 'admin',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user',
            'password' => Hash::make('user'),
            'no_telp' => 'user',
            'role' => 'user',
        ]);

        About::create([
            'id' => 1,
            'isi' => '',
        ]);
    }
}
