<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAvailability extends Model
{
    protected $table = 'product_availabilities';
    protected $guarded = [];
    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
