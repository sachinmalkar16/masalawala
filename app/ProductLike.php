<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLike extends Model
{
    // define the table name
    protected $table = 'product_likes';


    // provide a polymorphic relationship
    public function likes(  ) {
        return $this->morphTo();
    }

    // get user of a like (normal relationship)
    // this means the local 'user_id' field is the key (id) to the foreign table 'User'
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
    public function scopeOfType($query, $type)
    {
        return $query->where('like_type', $type);
    }

}
