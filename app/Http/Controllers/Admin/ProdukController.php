<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = $this->getAllProduk();
    
        return view('admin.produk.index', compact('produks'));
    }
    
    private function getAllProduk()
    {
        return Produk::all();
    }

   public function store(Request $request)
{
    $data = $this->validateProdukStore($request);

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $this->uploadImage($request->file('gambar'));
    }

    $this->createProduk($data);
    
    private function createProduk(array $data)
    {
        return Produk::create($data);
    }
    
    return back()->with('sukses', 'Produk berhasil ditambahkan');
}

    private function validateProdukStore(Request $request)
    {
        return $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }
    
        private function uploadImage($image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
    
        private const IMAGE_PATH = 'assets/img';
    
    $image->move(public_path(self::IMAGE_PATH), $imageName);
    
    return self::IMAGE_PATH . '/' . $imageName;
        
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
