<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardTransactionController extends Controller
{
    public function index(){
         $selltransaction = TransactionDetails::with(['transaction.user', 'product.galleries'])
            ->whereHas('product',function($product){
                $product->where('users_id',Auth::user()->id); // intinya adalah list produk yang dimiliki user klarena itu adalah produk yang di jual
            })->get();

         $buytransaction = TransactionDetails::with(['transaction.user', 'product.galleries'])
            ->whereHas('transaction',function($transaction){
                $transaction->where('users_id',Auth::user()->id); // intinya adalah list produk yang sudah masuk ke transaksi, artinya sudah dibeli
            })->get();


        return view('pages.dashboard-product-transaction',['selltransaction'=>$selltransaction, 
        'buytransaction'=>$buytransaction]);
    }

    public function details(Request $request,$id){
        $transactiondetail = TransactionDetails::with('transaction.user','product.galleries')->findOrFail($id);
        return view ('pages/dashboard-product-transaction-details',['transactiondetail'=>$transactiondetail]);
    }

    public function update(Request $request,$id){
        $data = $request->all();

        $item = TransactionDetails::findOrFail($id);
        $item->update($data);

        return redirect()->route('dashboard-transaction-details' , $id);
    }
}
