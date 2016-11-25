<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // use SoftDeletes;
    protected $table = 'products';

    //protected $dates = ['deleted_at'];

    protected $fillable = [
        'product_name',
        'indian_name',
        'description',
        'price',
        'unit',
        'market_price',
        'bulk_quantity',
        'bulk_discount',
        'roasted',
        'grinded',
        'product_category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\ProductCategory', 'product_category_id');
    }
    public function photos()
    {
        return $this->hasMany('App\ProductPhoto', 'product_id');
    }

    public function ratings()
    {
        return $this->hasMany('App\ProductRating', 'product_id');
    }

  /*  public function rating(){
        return $this->morphMany('App\ProductRating', 'rating');
    }*/

    public function inventory()
    {
        return $this->hasOne('App\ProductInventory');
    }
    public function rating(){
        $rating = $this->ratings();
        $avgRating = $rating->avg('rating');
        return round($avgRating,1);
    }

    public function reviewCount(){
        $reviews = $this->reviews()->notSpam()->approved();
        return $reviews->count();
    }

    public function reviews()
    {
        return $this->hasMany('App\ProductReview', 'product_id');
    }
}
