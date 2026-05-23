<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Fungsi untuk mengecek apakah user adalah admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Fungsi untuk mengecek apakah user adalah tamu
    public function isTamu()
    {
        return $this->role === 'tamu';
    }
}
