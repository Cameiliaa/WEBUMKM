<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Tampilkan daftar pesanan.
     */
    public function index()
    {
        $pesanans = Pesanan::latest()->get();
        return view('admin.pesanan.index', compact('pesanans'));
    }

    /**
     * Update status pesanan: diterima atau ditolak.
     */
    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->input('status');
        $pesanan->save();
    
        return redirect()->route('admin.pesanan.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }
    
}
