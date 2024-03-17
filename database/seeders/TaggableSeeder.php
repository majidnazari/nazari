<?php

namespace Database\Seeders;

use App\Models\Taggable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class TaggableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                "tag_id"=> 1,
                "taggable_type" =>  'App\Models\Article',
                "taggable_id" => 1,
               
            ],
            [
                "tag_id"=> 1,
                "taggable_type" => 'App\Models\Article',
                "taggable_id" => 2,
                
            ],
            [
                "tag_id"=> 1,
                "taggable_type" =>  'App\Models\Category',
                "taggable_id" => 1,
                
            ]
            ];

            Taggable::insert($data);
    }
}
