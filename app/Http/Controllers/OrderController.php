<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Show un-completed orders
     */
    public function show(){
        $user = Auth::user();
        $orders = $user->orders()
                        ->orderBy("created_at", "DESC")
                        ->whereNotNull("payment_id")
                        ->whereNotNull("start_at")
                        ->where("completed", false)
                        ->with("products")
                        ->paginate();

        return view("order.show", compact("user", "orders"));
    }

    
    
    /**
     * Show finished orders
     */
    public function finished(){
        $user = Auth::user();
        $orders = $user->orders()
                        ->orderBy("created_at", "DESC")
                        ->whereNotNull("payment_id")
                        ->whereNotNull("start_at")
                        ->where("completed", true)
                        ->with("products")
                        ->paginate();

        return view("order.finished", compact("user", "orders"));
    }
    

    /**
     * Rate the product
     */
    public function rate(Request $request, Cart $cartProduct){

        $request->validate([
            "rate"  => "required|numeric|min:1|max:5"
        ]);
        
        if($cartProduct->customer_id != Auth::id() || $cartProduct->rated){
            return abort(401);
        }
    
        if($cartProduct->product_id){
            if($cartProduct->product->rate_number == 1 && $cartProduct->product->rate_value == 0){
                $cartProduct->product->rate_value += $request->rate;
            } else {
                $cartProduct->product->rate_number += 1;
                $cartProduct->product->rate_value += $request->rate;
            }
            $cartProduct->product->save();

        }



        $cartProduct->rated = true;
        $cartProduct->rate = $request->rate;
        $cartProduct->save();

        Session::flash("success", "The product rated successfully");

        return back();
    }

    

}
