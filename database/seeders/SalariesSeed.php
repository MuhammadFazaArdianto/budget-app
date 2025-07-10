<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalariesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('salaries')->insert([
            [
                'user_id' => 2,
                'total_gaji' => 6000000.00,
                'tgl_gajian' => '2025-07-01',
            ],
        ]);
    }
}
