<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
        'store_name',
        'categories_id',
        'store_status',
        'address_one',
        'address_two',
        'provinces_id',
        'regencies_id',
        'zip_code',
        'country',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function product (){

    return $this->hasMany(Product::class,'users_id','id'); //bisa ambil data yang sudah di hapus dengan menambahkan ->WithTrashed();

   
}

public function galleries(){
    return $this->hasMany(ProductGallery::class,'users_id','id');
}


}
