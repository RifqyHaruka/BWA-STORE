<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    use HasFactory;
   
    protected $fillable = [
        "products_id",
        "users_id",
        ];

        public function product(){
            return $this->hasOne(Product::class, 'id','products_id');
        }

        public function user(){
            return $this->belongsTo(User::class,'users_id','id');
        }
}
