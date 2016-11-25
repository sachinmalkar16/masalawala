<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    // define the table name
    protected $table = 'product_ratings';

    // which fields can be updated?
    protected $fillable = [
        'rating', 'product_id', 'user_id'
    ];

    public function ratings() {
        return $this->morphTo();
    }
    // define the relationship with the user table
    // by joining this table's 'user_id' field with the user-table's 'id' field
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    
}
