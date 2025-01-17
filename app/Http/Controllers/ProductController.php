<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_product = products::all();
        return view('product_admin.index', compact('data_product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = categories::all();
        return view('product_admin.addproduct', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|numeric',
            'product_image' => 'required|image|mimes:jpeg,png,jpg', // Gambar opsional
        ]);

        // Proses upload gambar jika ada file yang diupload
       
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Nama file unik
            $image->move(public_path('products'), $imageName); // Simpan di folder public/products
        }

        // Simpan data produk ke database
        products::create([
            'category_id' => $request->input('category_id'),
            'product_name' => $request->input('product_name'),
            'product_description' => $request->input('product_description'),
            'product_price' => str_replace(',', '', $request->input('product_price')),
            'product_stock' => $request->input('product_stock'),
            'product_image' => $imageName, // Simpan path gambar
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('productadmin.index')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = products::findOrFail($id);
        $categories = categories::all();
        return view('productadmin.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|numeric',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar opsional
        ]);

        // Ambil data produk berdasarkan ID
        $data_product = products::findOrFail($id);

        // Hapus koma dari input harga dan simpan ke database
        $data_product->product_price = str_replace(',', '', $request->input('product_price'));

        // Proses upload gambar jika ada file yang diupload
        if ($request->hasFile('product_image')) {
            // Hapus gambar lama jika ada
            if ($data_product->product_image && file_exists(public_path('products/' . $data_product->product_image))) {
                unlink(public_path('products/' . $data_product->product_image));
            }

            // Upload gambar baru
            $image = $request->file('product_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Nama file unik
            $image->move(public_path('products'), $imageName); // Simpan di folder public/products

            // Update path gambar di database
            $data_product->product_image = $imageName;
        }

        // Update data produk
        $data_product->update([
            'category_id' => $request->input('category_id'),
            'product_name' => $request->input('product_name'),
            'product_description' => $request->input('product_description'),
            'product_stock' => $request->input('product_stock'),
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('productadmin.index')
                        ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil data produk berdasarkan ID
        $data_product = products::findOrFail($id);

        // Hapus gambar dari folder public/products jika ada
        if ($data_product->product_image && file_exists(public_path('products/' . $data_product->product_image))) {
            unlink(public_path('products/' . $data_product->product_image));
        }

        // Hapus data produk dari database
        $data_product->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('productadmin.index')
                        ->with('success', 'Produk berhasil dihapus.');
    }
}
