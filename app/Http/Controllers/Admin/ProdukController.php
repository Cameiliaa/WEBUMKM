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
    $data = $this->validateProdukUpdate($request);

    $data['gambar'] = $this->resolveProdukImage($request, $produk);

    private function resolveProdukImage(Request $request, Produk $produk)
    {
        if ($request->hasFile('gambar')) {
            return $this->uploadImage($request->file('gambar'));
        }
    
        return $produk->gambar;
    }

    $this->updateProduk($produk, $data);

    private function updateProduk(Produk $produk, array $data)
    {
        return $produk->update($data);
    }

        return back()->with('sukses', 'Produk berhasil diperbarui');
    }
    
    private function validateProdukUpdate(Request $request)
    {
    return $request->validate([
        'nama_produk' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
}

    public function destroy(Produk $produk)
    {
        $this->deleteProduk($produk);
    
        return back()->with('sukses', 'Produk berhasil dihapus');
    }
    
    private function deleteProduk(Produk $produk)
    {
        return $produk->delete();
    }
}
