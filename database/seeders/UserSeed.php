<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
               "name" => "Admin User",
                "email" => "admin@gmail.com",
                "role" => "admin",
                "password" => Hash::make('admin@gmail.com'),
            ],
            [
                "name" => "Ali Topan",
                "email" => "AliTopan@gmail.com",
                "role" => "admin",
                "password" => Hash::make('admin@gmail.com'),
            ]
        ]);
    }
}
