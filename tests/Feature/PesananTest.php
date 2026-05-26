<?php

namespace Tests\Feature;

use Tests\TestCase;

class PesananTest extends TestCase
{
    public function test_halaman_pesanan_bisa_diakses()
    {
        $response = $this->get('/pesanan/create');

        $response->assertStatus(302);
    }
}
