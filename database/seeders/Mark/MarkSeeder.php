<?php

namespace Database\Seeders\Mark;

use App\Http\Modules\Marks\Models\Mark;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mark::create(['name' => 'Mark 1']);
        Mark::create(['name' => 'Mark 2']);
        Mark::create(['name' => 'Mark 3']);
        Mark::create(['name' => 'Mark 4']);
    }
}
