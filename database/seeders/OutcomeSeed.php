<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutcomeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('outcomes')->insert([
            [
                'user_id' => 2,
                'kategori' => 'Makanan',
                'jumlah' => 500000,
                'tgl_pengeluaran' => '2023-10-10',
                'keterangan' => 'Pengeluaran bulanan untuk makanan',
            ],
            [
                'user_id' => 2,
                'kategori' => 'Transportasi',
                'jumlah' => 200000,
                'tgl_pengeluaran' => '2023-10-12',
                'keterangan' => 'Biaya transportasi harian',
            ],
        ]);
    }
}
