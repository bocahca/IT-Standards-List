<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Keamanan'],
            ['name' => 'Kualitas'],
            ['name' => 'Kinerja'],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(
                ['name' => $data['name']],
                [] // other attributes if any
            );
        }
    }
}
