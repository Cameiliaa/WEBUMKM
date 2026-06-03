<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * Memastikan fungsi isAdmin() mengembalikan true jika role-nya 'admin'
     */
    public function test_is_admin_returns_true_when_role_is_admin()
    {
        // Membuat User Palsu di RAM dengan status/state role = admin (Stub)
        $userAdmin = new User(['role' => 'admin']);

        // Penegasan hasil harus TRUE
        $this->assertTrue($userAdmin->isAdmin());
    }

    /**
     * Memastikan fungsi isAdmin() mengembalikan false jika role-nya bukan 'admin'
     */
    public function test_is_admin_returns_false_when_role_is_not_admin()
    {
        // Membuat User Palsu di RAM dengan status/state role = customer (Stub)
        $userCustomer = new User(['role' => 'customer']);

        // Penegasan hasil harus FALSE
        $this->assertFalse($userCustomer->isAdmin());
    }
}
