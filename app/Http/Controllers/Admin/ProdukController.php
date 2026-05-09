<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('admin.produk.index', compact('produks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
           private function uploadImage($image)
{
    $imageName = time() . '.' . $image->getClientOriginalExtension();

    $image->move(public_path('assets/img'), $imageName);

    return 'assets/img/' . $imageName;
}

        Produk::create($data);
        return back()->with('sukses', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/img'), $imageName);

            $data['gambar'] = 'assets/img/' . $imageName;
        } else {
            $data['gambar'] = $produk->gambar;
        }

        $produk->update($data);
        return back()->with('sukses', 'Produk berhasil diperbarui');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return back()->with('sukses', 'Produk berhasil dihapus');
    }
}
