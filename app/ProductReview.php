<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    // define the table name
    protected $table = 'product_reviews';

    // which fields can be updated?
    protected $fillable = [
        'comment', 'parent_id', 'product_id', 'user_id'
    ];

    /*protected $attributes = [
        'children' => '0',
    ];*/


    protected $children = array();
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

    public function parent()
    {
        return $this->belongsTo('App\ProductReview', 'parent_id');
    }

    public function replies()
    {
          return $this->hasMany('App\ProductReview', 'parent_id', 'id');
    }

    public function scopeNotReply( $query ) {
        return $query->where('parent_id',0);
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    public function scopeSpam($query)
    {
        return $query->where('spam', true);
    }

    public function scopeNotSpam($query)
    {
        return $query->where('spam', false);
    }
    public function getTimeagoAttribute()
    {
        $date = CarbonCarbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
        return $date;
    }
    public function loadChild() {
        $reviews= $this->replies;
        $this->user;
           if($reviews->count()) {
                foreach ($reviews as $review) {
                     $review->loadChild();
                }
            }
    }
  }
