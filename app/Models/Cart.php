<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [

        'user_id',
        'quantity',
        'product_id'
    ];
    protected $guarded = [];

    public function user () {

        return $this->belongsTo(User::class, 'user_id');

    }
    public function product() {

        return $this->belongsTo(Product::class, 'product_id');

    }

}
