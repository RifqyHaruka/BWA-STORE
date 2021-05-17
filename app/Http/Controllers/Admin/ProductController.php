<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

use App\Http\Requests\Admin\ProductRequest;
use illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax())
        {

            $query = Product::with(['user','category']); //ini kalau terdapat relasi di database, namanya liat di modelnya pada saat buat relasi
            return DataTables::of($query)
            ->addIndexColumn()
                ->addColumn('action',function($product){
                        return '
                            <div class ="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="'. route('product.edit',$product->id) .'" class="dropdown-item">
                                        Sunting
                                        </a>
                                        <form action="'. route('product.destroy',$product->id).'" method="POST">
                                            '. method_field('delete'). csrf_field() .'

                                            <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                            </button>
                                        </form>
                                    
                                    </div>
                                </div>
                            </div>
                        ';
                })

               
                 ->rawColumns(['action'])
                ->make();
            
        }
        
        return view("layouts.Admin.Product.index");    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();

        return view('layouts.Admin.Product.create' , 
        ['users' => $users, 
        'categories' => $categories] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all(); //ngambil yang udah di fillable
        $data['slug'] = Str::slug($request->name);
        Product::create($data);  //Jangan lupa ini modelnya 

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findorFail($id); //Mengirimkan ID
        $users = User::all(); //di get semua 
        $categories = Category::all(); //di get semua supaya bisa nampilin nama
        return view("layouts.Admin.Product.edit", 

        [
            "product" => $product,
            "users" => $users,
            "categories" => $categories
        ]
    
    );
            // "user" => $users
        
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
    
               
        $data  = $request->all();

        
        $data['slug'] = Str::slug($request->name);
        // $data['photo'] = $request->file('photo')->store('assets/product','public') ;
        $product = Product::findorFail($id); //Jangan lupa ini modelnya 

        $product->update($data);  

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $product=Product::findorFail($id);
       $product->galleries()->delete();
       $product->delete();
       return redirect()->route('product.index');
    }
}
