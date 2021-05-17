<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use Exception;
use Exeception;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Auth;
use Midtrans\Notification;
use PhpParser\Node\Expr\New_;

class CheckoutController extends Controller
{
    
    public function process(Request $request) {
        //Simpen user data

        $user = Auth::user();
        $user->update($request->except('total_price'));

        //proses checkout
        $code = 'STORE-'. mt_rand(0000,9999);
        $carts = Cart::with(['product','user'])->where('users_id', Auth::user()->id)->get();

        //Pembuatan transaksi
        $transaction = Transaction::create(['users_id' => Auth::user()->id, 
        'insurance_price'=>0, 
        'shipping_price'=>0,
        'total_price' =>$request->total_price,
        'transaction_status' => 'Pending',
        'code'=> $code ]);

        //Menyimpan transaction detalis
        foreach ($carts as $cart){
        $trx = 'TRX-'. mt_rand(0000,9999);

        TransactionDetails::create(['transactions_id' => $transaction->id, //karena id ga di tulis tapi dia ttp ada di database makanya ada $transaction->id
        'products_id'=>$cart->product->id, 
        'price'=>$cart->product->price,
        'shipping_status' =>'Pending',
        'resi' => '',
        'code'=> $trx ]);
        }

        //Delete cart data pas udah di checkout

        Cart::with(['product','user'])->where('users_id',Auth::user()->id)->delete();

       //Konfigurasi Midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.isProductionKey');
        // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('services.midtrans.is3ds');

        //Kirim Array ke midtrans
        $midtrans = [
            'transaction_details'=>[
                    'order_id' => $code,
                    'gross_amount' => (int) $request->total_price,
            ],
            'customer_details'=>[
                'first_name'=> Auth::user()->name,
                'email'=> Auth::user()->email,
            ],
            'enabled_payment'=>[
                'gopay', 'permata_va', 'indomaret', 'bank_transfer'
            ],

            'vtweb'=>[]
            ];

            try {
  // Get Snap Payment Page URL
                $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
                
                // Redirect to Snap Payment Page
                return redirect($paymentUrl);
                }
                catch (Exception $e) {
                echo $e->getMessage();
                }
    }


     public function callback(Request $request) 
    {
        //set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProductionKey');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        //Instance midtrans notification
        $notification = New Notification();

        //Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud=$notification->fraud_status;
        $order_id=$notification->order_id;
        //Cari transaksi berdasarkan ID
        $transaction = Transaction::findorFail($order_id);
        //Handle notification status

        if($status == 'capture'){
            if($type=='credit_cart'){
                if($fraud=='chalange'){
                    $transaction->status = "PENDING";

                }
              else {
                  $transaction->status = "SUCCESS";
              }  
            }
        }

        else if($status == 'settelment'){
            $transaction->status = "SUCCESS";
        }

         else if($status == 'pending'){
            $transaction->status = "PENDING";
        }

        else if($status == 'deny'){
            $transaction->status = "CANCELLED";
        }

        else if($status == 'expire'){
            $transaction->status = "CANCELLED";
        }

         else if($status == 'cance'){
            $transaction->status = "CANCELLED";
        }
        //Simpan transaksi

        $transaction->save();

        
    }


}
