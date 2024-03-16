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
        $data=[
            [
                "name" => "ورزشی",
                "des" => "ت ورزشی",
               
            ],
            [
                "name" => "تفریحی",
                "des" => "ت تفریحی",
            ],
            [
                "name" => "هنری",
                "des" => "ت هنری",
            ]
            ];

            Category::insert($data);
    }
}
