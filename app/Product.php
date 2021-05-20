<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected   $table = "products";

    
    /**
     * Relationship with the post
     */
    public function post(){
        return $this->belongsTo("App\Post", "post_id", "id");
    }


    /**
     * Get amount attribute
     */
    public function getAmountAttribute(){
        return  $this->attributes['s'] + 
                $this->attributes['m'] +
                $this->attributes['l'] +
                $this->attributes['xl'] +
                $this->attributes['xxl'] +
                $this->attributes['more'];
    }

    /**
     * Get rate value
     */
    public function getRateAttribute(){
        return $this->attributes['rate_value'] / $this->attributes['rate_number'];
    }
    
}
