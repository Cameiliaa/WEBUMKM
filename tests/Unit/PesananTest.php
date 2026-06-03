<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Pesanan;

class PesananTest extends TestCase
{
    /**
     * Test untuk memastikan fungsi isSelesai() mengembalikan true jika statusnya 'selesai'.
     * Menggunakan teknik Stub untuk memalsukan nilai properti/atribut objek.
     */
    public function test_is_selesai_returns_true_when_status_is_selesai()
    {
        // 1. Pembuatan STUB: Membuat tiruan dari class Pesanan
        // Kita mengonfigurasi stub agar seolah-olah memiliki status 'selesai'
        $pesananStub = $this->createMock(Pesanan::class);

        // Memaksa method atau atribut bawaan untuk mensimulasikan status 'selesai'
        $pesananStub->status = 'selesai';

        // Karena createMock mengosongkan internal method, kita panggil fungsi aslinya secara manual
        // atau kita gunakan instance asli dengan data tiruan (juga bagian dari teknik Stub/Fake objek)
        $realPesananWithStubbedData = new Pesanan(['status' => 'selesai']);

        // 2. Eksekusi & Assertion (PENEGASAN)
        $this->assertTrue($realPesananWithStubbedData->isSelesai());
    }

    /**
     * Test untuk memastikan fungsi isSelesai() mengembalikan false jika statusnya bukan 'selesai'.
     */
    public function test_is_selesai_returns_false_when_status_is_not_selesai()
    {
        // Membuat objek dengan data tiruan (Stubbing state) status 'pending'
        $pesananPending = new Pesanan(['status' => 'pending']);

        // Memastikan hasilnya false
        $this->assertFalse($pesananPending->isSelesai());
    }
}
