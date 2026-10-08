<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Speelgoed'],
            ['name' => 'Woning'],
            ['name' => 'Hobby'],
            ['name' => 'Kleding'],
            ['name' => 'Sport'],
            ['name' => 'Gereedschap'],
        ];

        foreach($categories as $category){
            Category::firstOrCreate([
                'name' => $category['name'],
            ]);
        }
    }
}
