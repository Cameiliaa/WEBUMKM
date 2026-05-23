<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    private const IMAGE_PATH = 'assets/img';

    public function index()
    {
        $produks = $this->getAllProduk();

        return view('admin.produk.index', compact('produks'));
    }

    public function store(Request $request)
    {
        $data = $this->validateProdukStore($request);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->uploadImage($request->file('gambar'));
        }

        $this->createProduk($data);

        return back()->with('sukses', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $this->validateProdukUpdate($request);

        $data['gambar'] = $this->resolveProdukImage($request, $produk);

        $this->updateProduk($produk, $data);

        return back()->with('sukses', 'Produk berhasil diperbarui');
    }

    public function destroy(Produk $produk)
    {
        $this->deleteProduk($produk);

        return back()->with('sukses', 'Produk berhasil dihapus');
    }

    private function getAllProduk()
    {
        return Produk::all();
    }

    private function validateProdukStore(Request $request)
    {
        return $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    private function validateProdukUpdate(Request $request)
    {
        return $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    private function uploadImage($image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path(self::IMAGE_PATH), $imageName);

        return self::IMAGE_PATH . '/' . $imageName;
    }

    private function resolveProdukImage(Request $request, Produk $produk)
    {
        if ($request->hasFile('gambar')) {
            return $this->uploadImage($request->file('gambar'));
        }

        return $produk->gambar;
    }

    private function createProduk(array $data)
    {
        return Produk::create($data);
    }

    private function updateProduk(Produk $produk, array $data)
    {
        return $produk->update($data);
    }

    private function deleteProduk(Produk $produk)
    {
        return $produk->delete();
    }
}
