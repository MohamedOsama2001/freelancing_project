<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Category;
use Illuminate\Http\Request;

class MaincategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('admin.maincategories.index',['categories'=>$categories]);
    }
    public function create(){
        return view('admin.maincategories.create');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>['required','string','min:3'],
            'image'=>['required']
        ]);
        $category=new Category;
        $category->name=$request->name;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $category->image = $imageName;
        }
        $category->save();
        return to_route('admin.maincategories.index');


    }
}
