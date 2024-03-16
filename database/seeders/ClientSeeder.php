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
                "password" => '$2a$12$eyHrOz0.4X2yc2rgO0qxR.zO5kgAHC04z4qAFsTSYLcy3YkMD8ix6',
                "mobile" => "09372120890",
                "email" =>"majidnazarister@gmail.com"
            ],
            [
                "user_name" => "ali",
                "password" => '$2a$12$eyHrOz0.4X2yc2rgO0qxR.zO5kgAHC04z4qAFsTSYLcy3YkMD8ix6',
                "mobile" => "",
                "email" =>""
            ],
            [
                "user_name" => "hassan",
                "password" => '$2a$12$eyHrOz0.4X2yc2rgO0qxR.zO5kgAHC04z4qAFsTSYLcy3YkMD8ix6',
                "mobile" => "",
                "email" =>""
            ]
            ];

            Client::insert($data);
    }
}
