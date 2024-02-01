<?php

namespace App\Http\Controllers;

use App\Models\LogM;
use App\Models\ProdukM;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\KategoriM;

class ProductC extends Controller
{
    public function product()
    {
        $kategoris = KategoriM::pluck('nama_kategori');
        $product = ProdukM::all();

        return view('Product.product', compact('product','kategoris'));
    }

    public function addProductForm()
    {
        $kategoris = KategoriM::pluck('nama_kategori');

        return view('Product.add-product', compact('kategoris'));
    }

    public function storeProduct(Request $request)
    {
        $kategori = KategoriM::where('nama_kategori', $request->input('id_kategori'))->first();

        if ($kategori) {
            ProdukM::create([
                'nama_produk' => $request->input('nama_produk'),
                'harga_produk' => $request->input('harga_produk'),
                'id_kategori' => $kategori->id_kategori,
                'stok' => $request->input('stok'),
            ]);

            LogM::create([
                'id_user' => auth()->user()->id,
                'activity' => 'Admin menambahkan produk baru',
            ]);

            return redirect()->route('product')->with('success', 'Berhasil Menambahkan Data Produk');
        } else {
            // Handle jika kategori tidak ditemukan
            return redirect()->route('product')->with('error', 'Gagal Menambahkan Data Produk, Kategori tidak ditemukan');
        }

    }
    public function edit($id)
    {
        $product = ProdukM::findOrFail($id);
        $kategoris = KategoriM::all();

        return view('Product.edit-product', compact('product', 'kategoris'));
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'nama_produk' => 'required',
        'harga_produk' => 'required',
        'id_kategori' => 'required|exists:kategori,nama_kategori', // Validasi agar nama_kategori ada di tabel kategori
    ]);

    try {
        // Retrieve the product based on the provided $id
        $product = ProdukM::findOrFail($id);

        // Retrieve kategori based on the provided nama_kategori
        $kategori = KategoriM::where('nama_kategori', $validatedData['id_kategori'])->first();

        $product->update([
            'nama_produk' => $validatedData['nama_produk'],
            'harga_produk' => $validatedData['harga_produk'],
            'id_kategori' => $kategori->id_kategori, // Gunakan id_kategori dari tabel kategori
            'stok' => $request->input('stok'), // Sesuaikan sesuai kebutuhan
        ]);

        // Add log or success message if necessary

        return redirect()->route('product')->with('success', 'Berhasil Update Data Produk');
    } catch (\Exception $e) {
        dd($e->getMessage());
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
    public function printProduct(Request $request)
{
    $kategori = $request->input('kategori');

    // Fetch products based on the selected category
    $productQuery = ProdukM::query();
    if ($kategori) {
        $productQuery->where('kategori', $kategori);
    }
    $product = $productQuery->get();

    // Generate PDF
    $pdf = PDF::loadView('Product.print-product', compact('product'));

    // Download the PDF or display it in the browser using 'stream'
    return $pdf->stream('product.pdf');
}

}