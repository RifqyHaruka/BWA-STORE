<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::take(6)->get();
        $products = Product::with('galleries')->paginate(8);
        
        return view('pages/categories' ,[
            'categories'=>$categories,
            'products' => $products
        ]);
    }

     public function detail(Request $request, $slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstorFail();
        $products = Product::with('galleries')->where('categories_id', $category->id)->paginate(8);
        return view('pages/categories' ,[
            'categories'=>$categories,
            'products' => $products
        ]);
    }
}
