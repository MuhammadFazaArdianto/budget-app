<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('incomes')->insert([
            [
                'user_id' => 2,
                'kategori' => 'Bonus',
                'jumlah' => 1000000,
                'tgl_pemasukan' => '2023-10-15',
                'keterangan' => 'Bonus tahunan',
            ],
            [
                'user_id' => 2,
                'kategori' => 'Usaha',
                'jumlah' => 3000000,
                'tgl_pemasukan' => '2023-10-05',
                'keterangan' => 'Pendapatan usaha bulanan',
            ],
        ]);
    }
}
