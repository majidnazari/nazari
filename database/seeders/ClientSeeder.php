<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                "user_name" => "majid",
                "password" => "12345",
                "mobile" => "09372120890",
                "email" =>"majidnazarister@gmail.com"
            ],
            [
                "user_name" => "ali",
                "password" => "12345",
                "mobile" => "",
                "email" =>""
            ],
            [
                "user_name" => "hassan",
                "password" => "12345",
                "mobile" => "",
                "email" =>""
            ]
            ];

            Client::insert($data);
    }
}
