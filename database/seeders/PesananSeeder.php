<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pesanan')->insert([
            'code_pemesanan' => 'PSQERWR12',
            'nama' => 'Budi Santoso',
            'tanggal' => '2025-06-01', 
            'produk' => 'Keripik Pisang Original',
            'harga' => 25000,
            'status' => 'Diproses',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
