<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    // define the table name
    protected $table = 'product_photos';

    // which fields can be updated?
    protected $fillable = [
        'image', 'product_id'
    ];
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
