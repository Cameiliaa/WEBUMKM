<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class LandingPageController extends Controller
{
    public function index()
    {
        $produks = Produk::all(); 

        return view('welcome', compact('produks'));
    }
}
