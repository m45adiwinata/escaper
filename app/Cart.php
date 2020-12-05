<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "carts";

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function sizeInitial()
    {
        return $this->belongsTo('App\ProductSize', 'product_size_id');
    }
}
