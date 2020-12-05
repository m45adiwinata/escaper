<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeSizeDef extends Model
{
    protected $table = 'typesize_def';
    public $timestamps = false;
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo('App\ProductType', 'type_id');
    }

    public function size()
    {
        return $this->belongsTo('App\ProductSize', 'size_id');
    }
}
