<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Work', 'color' => 'blue']);
        Category::create(['name' => 'Personal', 'color' => 'green']);
        Category::create(['name' => 'Shopping', 'color' => 'orange']);
        Category::create(['name' => 'Health', 'color' => 'red']);
        Category::create(['name' => 'Education', 'color' => 'purple']);
    }
}