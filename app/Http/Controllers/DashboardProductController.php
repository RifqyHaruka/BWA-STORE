<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductGallery;
use illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardProductController extends Controller
{
    public function index(){
       $produks =  Product::with('galleries','category','user')->where('users_id',Auth::user()->id)->get();
    return view('pages/dashboard-product', ['produks'=>$produks]);
}

public function details(Request $request,$id){
    $products = Product::with(['galleries','user','category'])->findOrFail($id);
    $categories = Category::all();
    return view('pages/dashboard-product-details',[
        'categories'=>$categories,
        'products'=>$products
    ]);
}

public function uploadGallery(Request $request){
    $data = $request->all(); //ngambil yang udah di fillable
        $data['photo'] = $request->file('photo')->store('assets/product','public'); 
        ProductGallery::create($data);  //Jangan lupa ini modelnya 
        return redirect()->route('dashboard-product-details',$request->products_id);
}

public function deleteGallery(Request $request,$id){
     $product = ProductGallery::findorFail($id); 
       $product->delete();
       return redirect()->route('dashboard-product-details', $product->products_id);
}

public function create(){
    $categories = Category::all();
    return view('pages/dashboard-product-create',['categories'=>$categories]);
}



public function store(ProductRequest $request){
    $data = $request->all();

    $data['slug'] = Str::slug($request->name);
 
    $product = Product::create($data);
    
    $gallery = [
        'users_id' => $product->users_id,
        'products_id' => $product->id,
        'photo' => $request->file('photo')->store('asset/product','public'),
    ];


     ProductGallery::create($gallery);

    return redirect()->route('dashboard-product');
}

public function update(ProductRequest $request, $id)
    {
    
               
        $data  = $request->all();

        
        $data['slug'] = Str::slug($request->name);
        // $data['photo'] = $request->file('photo')->store('assets/product','public') ;
        $product = Product::findorFail($id); //Jangan lupa ini modelnya 

        $product->update($data);  

        return redirect()->route('dashboard-product');
    }

}
