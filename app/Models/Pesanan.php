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
     * Tambahkan fungsi ini untuk logika bisnis yang akan di-test
     * Mengecek apakah status pesanan sudah bernilai 'selesai'
     */
    public function isSelesai(): bool
    {
        return $this->status === 'selesai';
    }
}
}
