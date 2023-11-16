<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Modules\Users\Models\User;
use Database\Seeders\Category\CategorySeeder;
use Database\Seeders\Mark\MarkSeeder;
use Database\Seeders\Product\ProductSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();


        User::factory()->create([
            'name' => 'Jhon Fabio Cardona',
            'email' => 'correo@correo.com',
            'password' => bcrypt('12345678'),
        ]);

        $this->call([
            CategorySeeder::class,
            MarkSeeder::class,
            ProductSeeder::class,
        ]);
        // \App\Http\Modules\Products\Models\Product::factory(10)->create();
    }
}
