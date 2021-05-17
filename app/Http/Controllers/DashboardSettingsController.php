<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
class DashboardSettingsController extends Controller
{
    public function settings(Request $request){
        $categories = Category::all();
        $user = Auth::user(); //Karena perlu data user yang sudah login
        return view("pages.dashboard-settings" , ['categories'=>$categories,
        'user'=>$user]);
    }

    public function account(){
        $user = Auth::user(); //Karena perlu data user yang sudah login

        return view('pages.dashboard-account',['user'=>$user]);
    }

    public function update(Request $request,$redirect){
        $data = $request->all();
        $item = Auth::user();

        $item->update($data);

        return redirect()->route($redirect);
    }
}
