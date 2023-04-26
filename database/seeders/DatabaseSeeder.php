<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
//         \App\Models\User::factory(10)->create();
//         \App\Models\Product::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

//         $arrayValues = ['active', 'draft'];
//         \App\Models\Category::factory(10)->create([
//             'name' => fake()->name(),
//             'status' => $arrayValues[rand(0,1)],
//         ]);

        $this->call([
           AdminsTableSeeder::class,
        ]);

    }
}
