<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::insert([
            [
                'nama_produk' => 'Keripik Apel',
                'harga' => 17000,
                'gambar' => 'assets/img/Keripik Apel.jpg',
            ],
            [
                'nama_produk' => 'Keripik Bakso',
                'harga' => 15000,
                'gambar' => 'assets/img/Keripik Bakso.jpg',
            ],
            [
                'nama_produk' => 'Keripik Mangga',
                'harga' => 15000,
                'gambar' => 'assets/img/Keripik Mangga.jpg',
            ],
            [
                'nama_produk' => 'Keripik Nangka',
                'harga' => 16000,
                'gambar' => 'assets/img/Keripik Nangka.jpg',
            ],
            [
                'nama_produk' => 'Keripik Pisang',
                'harga' => 13000,
                'gambar' => 'assets/img/Keripik Pisang.jpg',
            ],
            [
                'nama_produk' => 'Keripik Salak',
                'harga' => 17000,
                'gambar' => 'assets/img/Keripik Salak.jpg',
            ],
            [
                'nama_produk' => 'Keripik Talas',
                'harga' => 19000,
                'gambar' => 'assets/img/Keripik Talas.jpg',
            ],
            [
                'nama_produk' => 'Keripik Tempe',
                'harga' => 18000,
                'gambar' => 'assets/img/Keripik Tempe.jpg',
            ],
            [
                'nama_produk' => 'Keripik Singkong Pedas',
                'harga' => 20000,
                'gambar' => 'assets/img/Keripik Singkong Pedas.jpg',
            ],
        ]);
    }
}
