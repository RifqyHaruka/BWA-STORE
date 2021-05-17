<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
     protected $fillable = [
        'products_id','photo','users_id'
    ];

    protected $hidden = [

];

public function product (){

    return $this->belongsTo(Product::class,'products_id','id'); //bisa ambil data yang sudah di hapus dengan menambahkan ->WithTrashed();
}

public function user (){

    return $this->belongsTo(User::class,'users_id','id'); //bisa ambil data yang sudah di hapus dengan menambahkan ->WithTrashed();
}
}

