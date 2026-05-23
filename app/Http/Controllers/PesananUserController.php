<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class PesananUserController extends Controller
{
    public function create()
    {
        $produks = Produk::all();
        return view('tamu.pesanan.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'produk_id' => 'required|array|min:1',              // Pastikan minimal 1 produk dipilih
            'produk_id.*' => 'exists:produk,id',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $produk_list = [];
        $total = 0;

        foreach ($request->produk_id as $id) {
            $produk = Produk::find($id);
            if ($produk) {
                $produk_list[] = $produk->nama_produk; 
                $total += $produk->harga;
            }
        }

        if (empty($produk_list)) {
            return back()->withErrors(['produk_id' => 'Produk tidak valid atau tidak ditemukan.'])->withInput();
        }

        $buktiPath = null;

if ($request->hasFile('bukti_pembayaran')) {
    $buktiPath = $this->uploadBuktiPembayaran(
        $request->file('bukti_pembayaran')
    );
}
private function uploadBuktiPembayaran($file)
{
    $filename = time() . '_' . $file->getClientOriginalName();

    $file->move(public_path('assets/img/'), $filename);

    return 'assets/img/' . $filename;
}

private function generateKodePesanan()
{
    return 'PMN-' . strtoupper(Str::random(6));
}
        Pesanan::create([
            'code_pemesanan' => $this->generateKodePesanan(),
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'produk' => implode(', ', $produk_list),
            'harga' => $total,
            'status' => 'Diproses',
            'bukti_pembayaran' => $buktiPath,
        ]);

        return redirect()->route('tamu.pesanan.create')->with('success', 'Pesanan berhasil dibuat!');
    }
    public function history()
    {
        $pesanans = Pesanan::latest()->get();
        return view('tamu.pesanan.history', compact('pesanans'));
    }
    
    public function downloadNota($id)
    {
        $pesanan = Pesanan::findOrFail($id);
    
        if ($pesanan->status !== 'Diterima') {
            return back()->with('error', 'Nota hanya tersedia untuk pesanan yang diterima.');
        }
    
        $pdf = Pdf::loadView('tamu.pesanan.nota_pdf', compact('pesanan'));
    
        return $pdf->download('Nota_' . $pesanan->code_pemesanan . '.pdf');
    }

}
