<?php

namespace App\Http\Controllers;

use App\Models\LogM;
use App\Models\ProdukM;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductC extends Controller
{
    public function product()
    {
        $product = ProdukM::all();

        return view('Product.product', compact('product'));
    }

    public function addProductForm()
    {
        $kategoris = ProdukM::getEnumKategori();

        return view('Product.add-product', compact('kategoris'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'kategori' => [
                'required',
                Rule::in(ProdukM::getEnumKategori()),
            ],
        ]);

        try {
            ProdukM::create([
                'nama_produk' => $request->input('nama_produk'),
                'harga_produk' => $request->input('harga_produk'),
                'kategori' => $request->input('kategori'),
            ]);

            LogM::create([
                'id_user' => auth()->user()->id,
                'activity' => 'Admin menambahkan produk baru',
            ]);

            return redirect()->route('product')->with('success', 'Berhasil Menambahkan Data Produk');
        } catch (\Exception $e) {
            dd($e->getMessage());

            return redirect()->route('product')->with('error', 'Gagal Menambahkan Data Produk, Coba Lagi');
        }
    }
    public function edit($id)
    {
        // Fetch the user by ID from the database
        $product = ProdukM::findOrFail($id);

        return view('/Product/edit-product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
        ]);
    
        try {
            $product = ProdukM::findOrFail($id);
            $product->update($validatedData);

            LogM::create([
                'id_user' => auth()->user()->id, // Menggunakan ID kasir yang melakukan transaksi
                'activity' => 'Admin melakukan update produk',
            ]);
    
            return redirect()->route('product')->with('success', 'Berhasil Update Data Produk');
        } catch (\Exception $e) {
            return redirect()->route('product')->with('error', 'Gagal Update Data Produk, Mohon Coba Lagi');
        }
    }
    public function deleteProduct($id)
    {
        try {
            $product = ProdukM::findOrFail($id);
            $product->delete();

            return redirect()->route('product')->with('success', 'Berhasil Hapus Data Produk');
        } catch (\Exception $e) {
            return redirect()->route('product')->with('error', 'Gagal Hapus Data Produk, Mohon Coba Lagi');
        }
    }
}