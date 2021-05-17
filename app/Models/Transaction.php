<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";

    protected $fillable = [
        
       'users_id',
       'insurance_price',
       'shipping_price',
       'transaction_status',
       'total_price',
       'code',
       

       
    ];

     protected $hidden = [
        'password',
        'remember_token',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id','id');
    }
}
