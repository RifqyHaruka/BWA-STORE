<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::take(6)->get();
        $products = Product::with(['galleries'])->take(8)->get(); //Karena perlu gambar dari product galleries, 'galleries adalah function relasi yang ada di model product'
        return view('pages/home', 
        ['categories'=> $categories, 
        'products'=>$products]
    );
    }
}
