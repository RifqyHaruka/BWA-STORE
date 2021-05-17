<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

class DashboarController extends Controller
{
    public function index(){

        $customer=User::count();
        $revenue =Transaction::sum('total_price'); //Kalau pake kondisi bisa ditambahkan ::where('transactions_status','SUCCESS')->sum(total_price)
        $transaction = Transaction::count();

        return view("layouts/Admin/admin",
        ["customer"=>$customer,
        "revenue"=>$revenue ,
        "transaction"=>$transaction]); //Mengembalikan nilai untuk pindah kehalaman layouts.admin.admin, lalu kirimkan data customer yang nilainya $customer
    }
}
