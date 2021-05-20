<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected   $table = "posts";



    // Relationship with the category
    public function category(){
        return $this->belongsTo("App\Category", "category_id", "id");
    }


    // Relationship with the type
    public function type(){
        return $this->belongsTo("App\Type", "type_id", "id");
    }

    // Relatioonship with the user
    public function user(){
        return $this->belongsTo("App\User", "user_id", "id");
    }

    /**
     * Relationship with products
     */
    public function products(){
        return $this->hasMany("App\Product", "post_id", "id");
    }

    /**
     * Amount attrivute
     */
    public function getAmountAttribute(){

        if($this->relationLoaded('products')){
            $amount = 0;
            foreach($this->products as $product){
                $amount += $product->amount;
            }

            return $amount;
        }

        return 0;
    }

    
}
