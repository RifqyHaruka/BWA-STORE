<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
      public function index()
    {
        $carts = Cart::with(['product.galleries','user'])
                ->where('users_id' , Auth::user()->id)->get(); //ambil relasi product.galleries karena butuh foto, dan juuga user, dimana user id nya = dengan user yang login (Auth::user()->id), lalu di get
        return view('pages/carts' , [
            'carts'=>$carts
        ]);
    }


    public function delete(Request $request,$id){
        $cart=Cart::findOrFail($id);
        
        $cart->delete();
        return redirect()->route('cart');
    }

    public function success()
    {
        return view('pages/success');
    }

    
}
