<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orders;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($order_id)
    {
        $order = orders::with('orderitems.product')
            ->where('order_id', $order_id)
            ->where('user_id', Auth::id())
            ->first();

        $hasOrder = $order !== null;

        return view('utama.transaction', compact('order', 'hasOrder'));
    }

   public function history(Request $request)
    {
        try {
            $query = orders::where('user_id', Auth::id());

            // Filter berdasarkan status (opsional)
            if ($request->has('status') && !empty($request->status)) {
                $query->where('order_status', $request->status);
            }

            // Pencarian nomor pesanan (opsional)
            if ($request->has('search') && !empty($request->search)) {
                $query->where('order_id', 'LIKE', '%' . $request->search . '%');
            }

            $orders = $query->orderBy('created_at', 'desc')->get();

            return view('utama.history', compact('orders'));
        } catch (\Exception $e) {
            // Log error untuk debugging (opsional)
            // \Log::error('Error in history: ' . $e->getMessage());
            $orders = collect(); // Kembalikan koleksi kosong jika error
            return view('utama.history', compact('orders'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
