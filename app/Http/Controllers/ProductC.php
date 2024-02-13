<?php

namespace App\Http\Controllers;

use PDF;
use Exception;
use App\Models\LogM;
use App\Models\ProdukM;
use App\Models\KategoriM;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProductC extends Controller
{
    public function product()
    {
        $kategoris = KategoriM::pluck('nama_kategori');
        $kategories = KategoriM::all();
        $product = ProdukM::all();
        $userRole = auth()->user()->role;

        return view('Product.product', compact('product','kategoris','kategories', 'userRole'));
    }

    public function addProductForm()
    {
        $kategoris = KategoriM::pluck('nama_kategori');

        return view('Product.add-product', compact('kategoris'));
    }

    public function storeProduct(Request $request)
    {
        try {
        $request->validate([
            'id_kategori' => 'required',
            'nama_produk' => 'required|unique:products,nama_produk',
            'harga_produk' => 'required',
            'stok' => 'required|numeric',
        ]);
    
        $kategori = KategoriM::where('nama_kategori', $request->input('id_kategori'))->first();
    
        if ($kategori) {
            // Produk belum ada, tambahkan baru
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
    
            return redirect()->route('product')->with('success', 'Berhasil Tambah Data Produk');
            }
        } catch (Exception $e) {
            return redirect()->route('product')->with('error', 'Gagal Menambahkan Data Produk, Mohon Coba Lagi');
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
            'stok' => 'required',
        ]);

        try {
            // Retrieve the product based on the provided $id
            $product = ProdukM::findOrFail($id);

            $namaProduk = $product->nama_produk;

            // Retrieve kategori based on the provided nama_kategori
            $kategori = KategoriM::where('nama_kategori', $validatedData['id_kategori'])->first();

            $product->update([
                'nama_produk' => $validatedData['nama_produk'],
                'harga_produk' => $validatedData['harga_produk'],
                'id_kategori' => $kategori->id_kategori,
                'stok' => $validatedData['stok'],
            ]);

            LogM::create([
                'id_user' => auth()->user()->id,
                'activity' => "Admin melakukan edit produk $namaProduk",
            ]);

            return redirect()->route('product')->with('success', 'Berhasil Update Data Produk');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('product')->with('error', 'Gagal Update Data Produk, Mohon Coba Lagi');
        }
    }


    public function deleteProduct($id)
    {
        try {
            $product = ProdukM::findOrFail($id);
            $namaProduk = $product->nama_produk;
            $product->delete();
            
            LogM::create([
                'id_user' => auth()->user()->id,
                'activity' => "Admin menghapus produk $namaProduk",
            ]);

            return redirect()->route('product')->with('success', 'Berhasil Hapus Data Produk');
        } catch (Exception $e) {
            return redirect()->route('product')->with('error', 'Gagal Hapus Data Produk, Mohon Coba Lagi');
        }
    }
    public function printProduct(Request $request)
    {
        $kategori = $request->input('kategori');

        // Fetch products based on the selected category
        $productQuery = ProdukM::query();
        if ($kategori) {
            $productQuery->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('nama_kategori', $kategori);
            });
        }
        $product = $productQuery->get();

        // Generate PDF
        $pdf = PDF::loadView('Product.print-product', compact('product'));

        // Download the PDF or display it in the browser using 'stream'
        return $pdf->stream('product.pdf');
    }

}