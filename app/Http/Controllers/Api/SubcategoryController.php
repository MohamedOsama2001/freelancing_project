<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoryId = $request->query('category_id');
        
        if ($categoryId) {
            $cacheKey = "subcategories_category_{$categoryId}";

            $subcategories = Cache::remember($cacheKey, 60, function () use ($categoryId) {
                return Subcategory::where('category_id', $categoryId)->get();
            });

            return response()->json($subcategories, 200);
        }

        return response()->json([], 400);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','string'],
            'category_id'=>'required|exists:categories,id'
        ]);
        $subcategory=Subcategory::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id
        ]);
        Cache::forget("subcategories_category_{$request->category_id}");
        return response()->json($subcategory,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
