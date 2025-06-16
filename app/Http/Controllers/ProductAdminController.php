<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\products;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Info(
 *     title="BrightMart API",
 *     version="1.0.0",
 *     description="API untuk manajemen produk di BrightMart",
 *     @OA\Contact(
 *         email="support@brightmart.com"
 *     )
 * )
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class ProductAdminController extends Controller
{
    // public function __construct()
    // {
    //     // Middleware untuk view
    //     $this->middleware(['auth', 'role:admin'])->only(['index', 'create', 'edit']);
    //     // Middleware untuk API
    //     $this->middleware(['auth:sanctum', 'role:admin'])->only(['apiIndex', 'apiShow', 'store', 'update', 'destroy']);
    // }

    /**
     * Display a listing of the products (View).
     */
    public function index()
    {
        $data_product = products::all();
        return view('product_admin.index', compact('data_product'));
    }

    /**
     * Display a listing of products (API).
     * @OA\Get(
     *     path="/api/v1/products",
     *     summary="Get list of products",
     *     tags={"Products"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="product_id", type="integer", example=1),
     *                     @OA\Property(property="category_id", type="integer", example=1),
     *                     @OA\Property(property="product_name", type="string", example="Laptop"),
     *                     @OA\Property(property="product_description", type="string", example="High-end laptop"),
     *                     @OA\Property(property="product_price", type="number", example=1000000),
     *                     @OA\Property(property="product_stock", type="integer", example=10),
     *                     @OA\Property(property="product_image", type="string", nullable=true, example="123456.jpg")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     * @return JsonResponse
     */
    public function apiIndex(): JsonResponse
    {
        $products = products::all();
        return response()->json([
            'status' => 'success',
            'data' => $products,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/products",
     *     summary="Create a new product",
     *     tags={"Products"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"category_id","product_name","product_description","product_price","product_stock"},
     *                 @OA\Property(property="category_id", type="integer", example=1),
     *                 @OA\Property(property="product_name", type="string", example="Laptop"),
     *                 @OA\Property(property="product_description", type="string", example="High-end laptop"),
     *                 @OA\Property(property="product_price", type="number", example=1000000),
     *                 @OA\Property(property="product_stock", type="integer", example=10),
     *                 @OA\Property(property="product_image", type="file", format="binary", nullable=true)
     *             )
     *         )
     *     ),
     *     @OA\Response(response=201, description="Product created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function apiCreate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'product_stock' => 'required|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('product_image')) {
            $imageName = time() . '.' . $request->product_image->extension();
            $request->product_image->storeAs('public/images', $imageName);
        }

        $product = products::create([
            'category_id' => $validated['category_id'],
            'product_name' => $validated['product_name'],
            'product_description' => $validated['product_description'],
            'product_price' => $validated['product_price'],
            'product_stock' => $validated['product_stock'],
            'product_image' => $imageName,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

   /**
 * @OA\Post(
 *     path="/api/v1/products/store",
 *     summary="Store a new product",
 *     tags={"Products"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 required={"category_id","product_name","product_description","product_price","product_stock"},
 *                 @OA\Property(property="category_id", type="integer", example=1),
 *                 @OA\Property(property="product_name", type="string", example="Laptop"),
 *                 @OA\Property(property="product_description", type="string", example="High-end laptop"),
 *                 @OA\Property(property="product_price", type="number", example=1000000),
 *                 @OA\Property(property="product_stock", type="integer", example=10),
 *                 @OA\Property(property="product_image", type="file", format="binary", nullable=true)
 *             )
 *         )
 *     ),
 *     @OA\Response(response=201, description="Product stored successfully"),
 *     @OA\Response(response=422, description="Validation error"),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=500, description="Internal server error")
 * )
 */
public function apiStore(Request $request): JsonResponse
{
    \Log::info('apiStore called', ['request_data' => $request->all(), 'user' => auth()->user()]);

    try {
        $validated = $request->validate([
            'category_id' => 'required|integer|exists:categories,category_id',
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'product_stock' => 'required|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        \Log::info('Validation passed', ['validated_data' => $validated]);

        $imageName = null;
        if ($request->hasFile('product_image')) {
            $imageName = time() . '.' . $request->product_image->extension();
            $request->product_image->storeAs('public/images', $imageName);
            \Log::info('Image uploaded', ['image_name' => $imageName]);
        }

        $product = products::create([
            'category_id' => $validated['category_id'],
            'product_name' => $validated['product_name'],
            'product_description' => $validated['product_description'],
            'product_price' => $validated['product_price'],
            'product_stock' => $validated['product_stock'],
            'product_image' => $imageName,
        ]);

        \Log::info('Product created', ['product_id' => $product->product_id]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product stored successfully',
            'data' => $product
        ], 201);
    } catch (ValidationException $e) {
        \Log::error('Validation failed', ['errors' => $e->errors()]);
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        \Log::error('Error in apiStore', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred while storing the product',
            'error' => $e->getMessage()
        ], 500);
    }
}

    /**
     * @OA\Get(
     *     path="/api/v1/products/{id}",
     *     summary="Get a specific product",
     *     tags={"Products"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="product_id", type="integer", example=1),
     *                 @OA\Property(property="category_id", type="integer", example=1),
     *                 @OA\Property(property="product_name", type="string", example="Laptop"),
     *                 @OA\Property(property="product_description", type="string", example="High-end laptop"),
     *                 @OA\Property(property="product_price", type="number", example=1000000),
     *                 @OA\Property(property="product_stock", type="integer", example=10),
     *                 @OA\Property(property="product_image", type="string", example="123456.jpg", nullable=true)
     *             )
     *         )
     *     ),
     *     @OA\Response(response=404, description="Product not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function apiShow($id): JsonResponse
    {
        $product = products::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/products/{id}",
     *     summary="Update a product",
     *     tags={"Products"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="category_id", type="integer", example=1),
     *                 @OA\Property(property="product_name", type="string", example="Laptop"),
     *                 @OA\Property(property="product_description", type="string", example="Updated description"),
     *                 @OA\Property(property="product_price", type="number", example=1200000),
     *                 @OA\Property(property="product_stock", type="integer", example=15),
     *                 @OA\Property(property="product_image", type="file", format="binary", nullable=true)
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Product updated successfully"),
     *     @OA\Response(response=404, description="Product not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function apiUpdate(Request $request, $id): JsonResponse
    {
        $product = products::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'category_id' => 'sometimes|',
            'product_name' => 'sometimes|string|max:255',
            'product_description' => 'sometimes|string',
            'product_price' => 'sometimes|numeric|min:0',
            'product_stock' => 'sometimes|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = $product->product_image;
        if ($request->hasFile('product_image')) {
            if ($imageName) {
                Storage::delete('public/images/' . $imageName);
            }
            $imageName = time() . '.' . $request->product_image->extension();
            $request->product_image->storeAs('public/images', $imageName);
        }

        $product->update(array_merge([
            'product_image' => $imageName,
        ], $validated));

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'data' => $product
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/products/{id}",
     *     summary="Delete a product",
     *     tags={"Products"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Product deleted successfully"),
     *     @OA\Response(response=404, description="Product not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function apiDelete($id): JsonResponse
    {
        $product = products::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        if ($product->product_image) {
            Storage::delete('public/images/' . $product->product_image);
        }

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully'
        ], 200);
    }

    /**
     * Show the form for creating a new product (View).
     */
    public function create()
    {
        $categories = categories::all();
        return view('product_admin.addproduct', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|',
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'product_stock' => 'required|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products'), $imageName);
        }

        $product = products::create([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_price' => str_replace(',', '', $request->product_price),
            'product_stock' => $request->product_stock,
            'product_image' => $imageName,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Produk berhasil ditambahkan.',
                'data' => $product,
            ], 201);
        }

        return redirect()->route('productadmin.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing a product (View).
     */
    public function edit(string $id)
    {
        $product = products::findOrFail($id);
        $categories = categories::all();
        return view('product_admin.productedit', compact('product', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required|',
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'product_stock' => 'required|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = products::findOrFail($id);

        if ($request->hasFile('product_image')) {
            if ($product->product_image && file_exists(public_path('products/' . $product->product_image))) {
                unlink(public_path('products/' . $product->product_image));
            }
            $image = $request->file('product_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products'), $imageName);
            $product->product_image = $imageName;
        }

        $product->update([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_price' => str_replace(',', '', $request->product_price),
            'product_stock' => $request->product_stock,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Produk berhasil diperbarui.',
                'data' => $product,
            ], 200);
        }

        return redirect()->route('productadmin.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $product = products::findOrFail($id);

        if ($product->product_image && file_exists(public_path('products/' . $product->product_image))) {
            unlink(public_path('products/' . $product->product_image));
        }

        $product->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Produk berhasil dihapus.',
            ], 200);
        }

        return redirect()->route('productadmin.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
