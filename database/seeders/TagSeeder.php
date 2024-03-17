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
                    "name"=> 'تمرینی',               
                ],
                [
                    "name"=> 'آموزشی',               
                ],
                [
                    "name"=> 'فکری',
                ]
            ];

            Tag::insert($data);
    }
}
