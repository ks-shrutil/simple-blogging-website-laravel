<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   // database/seeders/CategorySeeder.php
public function run()
{
    \App\Models\Category::create(['name' => 'Technology']);
    \App\Models\Category::create(['name' => 'Health']);
    \App\Models\Category::create(['name' => 'Lifestyle']);
    \App\Models\Category::create(['name' => 'Travel']);
    \App\Models\Category::create(['name' => 'Food']);
}

}
