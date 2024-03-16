<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                "taggable_type" =>  'App\Models\Article',
                "taggable_id" => 1,
               
            ],
            [
                "taggable_type" => 'App\Models\Article',
                "taggable_id" => 2,
                
            ],
            [
                "taggable_type" =>  'App\Models\Article',
                "taggable_id" => 3,
                
            ]
            ];

            Tag::insert($data);
    }
}
