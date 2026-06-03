<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * Menguji apakah fungsi isAdmin() mengembalikan true jika role-nya 'admin'.
     */
    public function test_is_admin_returns_true_when_role_is_admin()
    {
        // Menyuntikkan data palsu ke objek (Stubbing State)
        $userAdmin = new User(['role' => 'admin']);

        // Penegasan (Assertion)
        $this->assertTrue($userAdmin->isAdmin());
    }

    /**
     * Menguji apakah fungsi isAdmin() mengembalikan false jika role-nya bukan 'admin'.
     */
    public function test_is_admin_returns_false_when_role_is_customer()
    {
        $userCustomer = new User(['role' => 'customer']);

        $this->assertFalse($userCustomer->isAdmin());
    }
}
