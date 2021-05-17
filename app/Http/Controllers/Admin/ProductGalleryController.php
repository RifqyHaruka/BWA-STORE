<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Http\Requests\Admin\ProductGalleryRequest;
use App\Models\ProductGallery;
use illuminate\Support\Str;
class ProductGalleryController extends Controller
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

            $query = ProductGallery::with(['product','user']); //ini kalau terdapat relasi di database, namanya liat di modelnya pada saat buat relasi
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
                                         <form action="'. route('product-gallery.destroy',$product->id).'" method="POST">
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

                ->editColumn('photo', function($product){
                    return $product->photo ? '<img src = "'. Storage::url($product->photo) .'" style="max-height: 80px;"/>':'';
                })
                 ->rawColumns(['action','photo'])
                ->make();
            
        }
        
        return view("layouts.Admin.Product-gallery.index");    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $users = User::all();
        return view('layouts.Admin.Product-gallery.create' , 
        ['products'=> $products, 
        'users'=> $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all(); //ngambil yang udah di fillable
        $data['photo'] = $request->file('photo')->store('assets/product','public'); 
        ProductGallery::create($data);  //Jangan lupa ini modelnya 
        return redirect()->route('product-gallery.index');
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
    public function update(ProductGalleryRequest $request, $id)
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
       $product = ProductGallery::findorFail($id); 
       $product->delete();
       return redirect()->route('product-gallery.index');
    }
}
