<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                "title" => "مقاللات هنری دسته اول",
                "des" => "ندراد",
                "category_id" => 3,
               
            ],
            [
                "title" => "مقاللات ورزشی دسته اول",
                "des" => "ندراد",
                "category_id" => 1,
            ],
            [
                "title" => "مقاللات تفرحی دسته اول",
                "des" => "ندراد",
                "category_id" => 2,
            ]
            ];

            Article::insert($data);
    }
}
