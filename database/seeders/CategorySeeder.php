<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Alta gama']);
        Category::create(['name' => 'Gama media']);
        Category::create(['name' => 'Gama baja']);
    }
}