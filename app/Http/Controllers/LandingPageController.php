<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class LandingPageController extends Controller
{
    public function index()
    {
        $produks = $this->getAllProduk();
    
        return view('welcome', compact('produks'));
    }
    
    private function getAllProduk()
    {
        return Produk::all();
    }
}
