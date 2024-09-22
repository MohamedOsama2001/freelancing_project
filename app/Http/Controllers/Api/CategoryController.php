<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Cache::remember('categories', 60, function () {
            return Category::all();
        });
        return $categories;
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
    public function show($id)
    {
        $category=Category::with('subcategory')->find($id);
        if(!$category){
            return response()->json(['error' => 'Category not found'], 404);
        }
        return response()->json($category);
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
    public function getAllCategoriesWithDetails()
    {
        $categories = Cache::remember('categories_with_details', 60, function () {
            return Category::with(['subcategory.product'])->get();
        });
    
        return response()->json([
            'subcategories' => $categories
        ]);
    }
}
