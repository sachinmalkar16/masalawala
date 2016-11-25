<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    // use SoftDeletes;
    protected $table = 'product_category';

    // protected $dates = ['deleted_at'];

    //
    protected $fillable = [
        'product_category',
        'description',
    ];


    public function products()
    {
        return $this->hasMany('App\Product', 'product_category_id');
    }
}
