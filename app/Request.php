<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected   $table = "requests";


    public function order(){
        return $this->belongsTo("App\Order", "order_id");
    }


    public function product(){
        return $this->belongsTo("App\Cart", "product_id");
    }

    public function customer(){
        return $this->belongsTo("App\User", "customer_id");
    }

    public function shipping(){
        return $this->belongsTo("App\Shipping", "shipping_id");
    }

    public function designer(){
        return $this->belongsTo("App\User", "designer_id");
    }

    public function messages(){
        return $this->hasMany("App\Message", "request_id");
    }
    
}
