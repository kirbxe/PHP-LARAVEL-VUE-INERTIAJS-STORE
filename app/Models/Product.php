<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'size',
        'description',
        'price',
        'brand_id',
        'path_picture' 
    ];
    protected $guarded = [];


    public function brand(){

        return $this->belongsTo(Brand::class, 'brand_id');

    }
    public function cartItems() {

        return $this->hasMany(Cart::class, 'product_id');

    }

}
