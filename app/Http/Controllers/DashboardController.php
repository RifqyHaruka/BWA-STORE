<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetails;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        $transaction = TransactionDetails::with(['transaction.user', 'product.galleries'])
            ->whereHas('product',function($product){
                $product->where('users_id',Auth::user()->id); //Ngecek apakah produk ada dan produk hanya milik user yang sedang login
            });

           
        
            $revenue = $transaction->get()->reduce(function ($carry, $item){
                return $carry + $item->price;
            });

            $customer = User::count();
    return view('pages/dashboard',[
        'transaction_count'=> $transaction->count(), 
        'transaction_data'=> $transaction->get(),
        'revenue'=>$revenue, 
        'customer'=>$customer]);
}


}
