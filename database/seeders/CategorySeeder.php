<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            [
                "name" => "Elektronik"
            ],
            [
                "name" => "Fashion Pria"
            ],
            [
                "name" => "Fashion Wanita"
            ],
            [
                "name" => "Handphone & Tablet"
            ],
            [
                "name" => "Olahraga"
            ],
        ];

        foreach ($categories as $c) {
            Category::create($c);
        }
    }
}
