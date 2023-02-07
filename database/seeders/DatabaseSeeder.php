<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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

         \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@localhost',
             'password' => Hash::make('123'),
             'is_admin'=>true,
        ]);
        $this->call(CategoriesSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(SourceSeeder::class);
    }
}
