<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_category = categories::all();
        return view('category_admin.index', compact('data_category'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = categories::all();
        return view('category_admin.addcategory', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        categories::create([
            'category_name' => $request->input('category_name'),
        ]);

        return redirect()->route('categoryadmin.index')->with('success', 'Kategori Berhasil Dibuat.');
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
        $categories = categories::findOrFail($id);
        return view('category_admin.categoryedit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $categories = categories::findOrFail($id);

        $categories->update([
            'category_name' => $request->input('category_name'),
        ]);
        return redirect()->route('categoryadmin.index')
                        ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        categories::find($id)->delete();
        return redirect()->route('categoryadmin.index')
                        ->with('success', 'Kategori Berhasil Dihapus.');
    }
}
