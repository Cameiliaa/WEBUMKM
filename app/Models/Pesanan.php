<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'code_pemesanan',
        'nama',
        'tanggal',
        'produk',
        'harga',
        'status',
        'bukti_pembayaran',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Mengecek apakah status pesanan sudah bernilai 'selesai'
     * Fungsi ini yang akan diuji di dalam PesananTest.php
     */
    public function isSelesai(): bool
    {
        return $this->status === 'selesai';
    }
}
