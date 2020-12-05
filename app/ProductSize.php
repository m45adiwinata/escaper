<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $table = 'product_sizes';
    public $timestamps = false;

    public function typedef()
    {
        return $this->hasMany('App\TypeSizeDef', 'size_id');
    }
}
