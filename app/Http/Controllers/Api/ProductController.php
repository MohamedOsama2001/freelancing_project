<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Cache::remember('products', 60, function () {
            return Product::with(['category', 'subcategory', 'productImage'])->get();
        });
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'type' => 'required|string',
            'Ad_title' => 'required|string|max:70',
            'Ad_descrp' => 'required|string|max:4096',
            'location' => 'required|string',
            'payment_options' => 'string',
            'price' => 'required|numeric',
            'name' => 'required|string',
            'phone' => 'required|string|regex:/^(\+?\d{1,3}[-.\s]?)?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/',
            'contact_method' => 'required|string',
            'product_image' => 'required',
            'product_image.*' => 'image|mimes:jpg,jpeg,png,webp,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // إنشاء المنتج
        $product = Product::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->input('subcategory_id'),
            'type' => $request->input('type'),
            'Ad_title' => $request->input('Ad_title'),
            'Ad_descrp' => $request->input('Ad_descrp'),
            'location' => $request->input('location'),
            'payment_options' => $request->input('payment_options','cash'),
            'price' => $request->input('price'),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'contact_method' => $request->input('contact_method'),
            'user_id'=>$request->input('user_id')
        ]);

        // تخزين الصور
        if ($request->hasFile('product_image')) {
            foreach ($request->file('product_image') as $image) {
                $path = $image->store('images', 'public');
                $product->productImage()->create([
                    'product_image' => 'storage/' . $path
                ]);
            }
        }

        // إرجاع استجابة ناجحة
        return response()->json($product->load('productImage'), 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product=Product::with('productImage','category','subcategory')->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
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
        $product =Product::with("productImage")->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        foreach ($product->productImage as $image) {
            $imagePath = 'public/' . $image->path;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            $image->delete();
        }
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
    public function getUSerProducts($userId){
        $cacheKey = "user_products_{$userId}" . request('page', 1);
        $products = Cache::remember($cacheKey, 60, function () use ($userId) {
            return Product::where('user_id', $userId)->with('productImage')->paginate(10);
        });
        return response()->json($products);
    }
    public function getCategoryProducts($catId){
        $cacheKey = "category_products_{$catId}";
        $products = Cache::remember($cacheKey, 60, function () use ($catId) {
            return Product::where('category_id', $catId)->with('productImage')->get();
        });
        return response()->json($products);
    }
}