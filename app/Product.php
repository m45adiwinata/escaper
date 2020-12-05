<?php

namespace App;
use Illuminate\Support\Facades\File;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $casts = ['image' => 'json'];

    public function type()
    {
    	return $this->belongsTo('App\ProductType', 'product_type_id');
    }

    public function availability()
    {
        return $this->hasMany('App\ProductAvailability');
    }

    public function setPicturesAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['image'] = json_encode($pictures);
        }
    }

    public function getPicturesAttribute($pictures)
    {
        return json_decode($pictures, true);
    }

    public function productId()
    {
        return $this->hasMany('App\ProductId', 'last_id');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($model)
        {
            $model->availability()->delete();
            $directory = public_path('/images/products/'.$model->id);
            File::deleteDirectory($directory);
        });
    }
}
