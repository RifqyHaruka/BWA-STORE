<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryRequest;
use illuminate\Support\Str;
class CategoryControllerr extends Controller
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

            $query = Category::query();
            return DataTables::of($query)
            ->addIndexColumn()
                ->addColumn('action',function($item){
                        return '
                            <div class ="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="'. route('category.edit',$item->id) .'" class="dropdown-item">
                                        Sunting
                                        </a>
                                        <form action="'. route('category.destroy',$item->id).'" method="POST">
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

                ->editColumn('photo',function($item){
                    return $item->photo ? '<img src="'. Storage::url($item->photo) .' "style="max-height:40px;""/>' :'';
                })
                 ->rawColumns(['action','photo'])
                ->make();
            
        }
        
        return view("layouts.Admin.Categories.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.Admin.Categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all(); //ngambil yang udah di fillable

        $data['slug'] = Str::slug($request->name); //udah darisananya Str::slug,$request->nama nya adalah field nama dari database
        $data['photo'] = $request->file('photo')->store('assets/category','public') ;
        Category::create($data);  //Jangan lupa ini modelnya 

        return redirect()->route('category.index');
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
        $item = Category::findorFail($id); //Mengirimkan ID
        return view("layouts.Admin.Categories.edit",compact("item"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data= $request->validate([
        'name'=> 'required|string',
        'photo'=>'nullable',
        
        
        
    ]);
       
        $data['slug'] = Str::slug($request->name);
        // $data['photo'] = $request->file('photo')->store('assets/category','public') ;
        $item = Category::findorFail($id); //Jangan lupa ini modelnya 
        $item->update($data);  

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $item=Category::findorFail($id);
       $item->delete();
       return redirect()->route('category.index');
    }
}
