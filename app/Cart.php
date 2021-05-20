<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Cart extends Model
{
    protected   $table = "cart";


    /**
     * Relationship with orders
     */
    public function order(){
        return $this->belongsTo("App\Order", "order_id", "id");
    }


    /**
     * Relationship with product
     */
    public function product(){
        return $this->belongsTo("App\Product", "product_id", "id");
    }

    /**
     * Get total price value
     */
    public function getTotalAttribute(){
        return $this->getAmountAttribute() * $this->attributes["price"];
    }

    /**
     * Get sizes array seprated by comma
     */
    public function getSizesAttribute(){

        $arr = [
            $this->attributes['s'] ? "small" : null,
            $this->attributes['m'] ? "medium" : null,
            $this->attributes['l'] ? "large" : null,
            $this->attributes['xl'] ? "x-large" : null,
            $this->attributes['xxl'] ? "xx-large" : null,
            $this->attributes['more'] ? "more" : null
        ];

        return implode(", ", array_filter($arr, function($value){
            return !!$value;    // Bang Bang
        }));

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
     * Get Image path attribute
     */
    public function getImageAttribute(){
        return Storage::url($this->attributes["path"]);
    }
    
}
