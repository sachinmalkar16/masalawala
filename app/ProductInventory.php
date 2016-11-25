<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{

    protected $table = 'product_inventory';

    protected $fillable = [
        'product_id',
        'total_quantity',
        'utilized',
        'blocked',
        'threshold'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
