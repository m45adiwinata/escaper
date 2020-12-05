<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_types';
    public $timestamps = false;

    public function products()
    {
    	return $this->hasMany('App\Product', 'product_type_id');
    }

    public function typedef()
    {
        return $this->hasMany('App\TypeSizeDef', 'type_id');
    }
}
