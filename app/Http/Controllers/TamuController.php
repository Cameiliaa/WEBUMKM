<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class TamuController extends Controller
{
    public function index()
    {
        $produks = Produk::all(); 
        return view('tamu.dashboard', compact('produks')); 
    }
}
