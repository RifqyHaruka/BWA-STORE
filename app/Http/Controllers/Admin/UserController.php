<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Product;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Hash;
use illuminate\Support\Str;
class UserController extends Controller
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

            $query = User::with(['product']);
            return DataTables::of($query)
            ->addIndexColumn()
                ->addColumn('action',function($user){
                        return '
                            <div class ="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="'. route('user.edit',$user->id) .'" class="dropdown-item">
                                        Sunting
                                        </a>
                                        <form action="'. route('user.destroy',$user->id).'" method="POST">
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
        
        return view("layouts.Admin.User.index");    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.Admin.User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all(); //ngambil yang udah di fillable
        // $data['password'] = Hash::make($request->password);
         $data['password'] = bcrypt($request->password);
        User::create($data);  //Jangan lupa ini modelnya 

        return redirect()->route('user.index');
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
        $user = User::findorFail($id); //Mengirimkan ID
        return view("layouts.Admin.User.edit",compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
    
           
        $data  = $request->all();

        if($request->password){ //$request->password adalah value data nya diambil dari name dari form
            $data['password'] = Hash::make($request->password); //$data['password'] yang dari validate
        }

        else{
            unset($data["password"]);
        }
        // $data['photo'] = $request->file('photo')->store('assets/user','public') ;
        $user = User::findorFail($id); //Jangan lupa ini modelnya 
        $user->update($data);  

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $user=User::findorFail($id);
       $user->product()->delete();
       $user->galleries()->delete();
       $user->delete();
       return redirect()->route('user.index');
    }
}
