<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\orders;
use App\Models\orderitems;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth'); // Pastikan pengguna login
    // }

    // Tampilkan halaman keranjang
    public function index()
    {
        $cartItems = cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->qty * $item->product->product_price;
        });

        return view('utama.cart', compact('cartItems', 'total'));
    }

    // Tambah produk ke keranjang
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'qty' => 'required|integer|min:1',
        ]);

        $product = products::find($request->product_id);
        if ($product->product_stock < $request->qty) {
            return redirect()->back()->with('error', 'Stok tidak cukup!');
        }

        $cartItem = cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->qty += $request->qty;
            $cartItem->save();
        } else {
            cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'qty' => $request->qty,
            ]);
        }

        return redirect()->route('cart')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // Update jumlah item di keranjang
    public function update(Request $request, $cart_id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $cartItem = cart::where('cart_id', $cart_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cartItem) {
            return response()->json(['error' => 'Item tidak ditemukan'], 404);
        }

        if ($cartItem->product->product_stock < $request->qty) {
            return response()->json(['error' => 'Stok tidak cukup!'], 400);
        }

        $cartItem->qty = $request->qty;
        $cartItem->save();

        return response()->json(['success' => 'Jumlah produk diperbarui!']);
    }

    // Hapus item dari keranjang
    public function remove($cart_id)
    {
        $cartItem = cart::where('cart_id', $cart_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->delete();

        return redirect()->route('cart')->with('success', 'Produk dihapus dari keranjang!');
    }

    // Proses checkout
    public function checkout()
    {
        $cartItems = cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();
        try {
            $total = $cartItems->sum(function ($item) {
                return $item->qty * $item->product->product_price;
            });

            // Buat order
            $order = orders::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'order_status' => 'pending',
            ]);

            // Tambahkan item ke orderitems dan kurangi stok
            foreach ($cartItems as $item) {
                if ($item->product->product_stock < $item->qty) {
                    throw new \Exception('Stok tidak cukup untuk produk: ' . $item->product->product_name);
                }

                orderitems::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item->product_id,
                    'qty' => $item->qty,
                    'price' => $item->product->product_price,
                ]);

                $item->product->product_stock -= $item->qty;
                $item->product->save();
            }

            // Kosongkan keranjang
            cart::where('user_id', Auth::id())->delete();

            DB::commit();
            return redirect()->route('cart')->with('success', 'Checkout berhasil! Pesanan Anda sedang diproses.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart')->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }
}