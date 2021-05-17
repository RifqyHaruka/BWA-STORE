<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
class DetailController extends Controller
{
    public function index(Request $request, $id)
    {
        $products = Product::with(['galleries','user'])->where('slug',$id)->firstOrFail();
        return view('pages/details',[
            'products' => $products
            
            ]);
    }

    public function add(Request $request, $id){
        $data = [
            'products_id'=>$id,
            'users_id'=>Auth::user()->id,
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }
}
