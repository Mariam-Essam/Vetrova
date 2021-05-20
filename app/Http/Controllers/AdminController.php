<?php

namespace App\Http\Controllers;

use App\Order;
use App\Post;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use App\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function activeOrders(){
        $user = Auth::user();

        $orders = Order::where("completed", "=", 0)
                        ->whereNotNull("start_at")
                        ->orderBy("start_at", "ASC")
                        ->with("products")
                        ->whereNotNull("payment_id")
                        ->paginate();
        
        $active = true;
        return view("admin.orders", compact("user", "orders", "active"));
    }

    public function completeOrders(){
        $user = Auth::user();

        $orders = Order::where("completed", "=", 1)
                        ->whereNotNull("start_at")
                        ->orderBy("start_at", "ASC")
                        ->with("products")
                        ->whereNotNull("payment_id")
                        ->paginate();
        
        $active = false;
        return view("admin.orders", compact("user", "orders", "active"));
    }

    public function activePosts(){
        $user = Auth::user();

        $posts = Post::where("active", "=", 1)
                        ->with("category", "type", "user", "products")
                        ->paginate();
        
        return view("admin.dashboard", compact("user", "posts"));
    }

    public function unActivePosts(){
        $user = Auth::user();

        $posts = Post::where("active", "=", 1)
                        ->with("category", "type", "user", "products")
                        ->paginate();
        
        return view("admin.dashboard", compact("user", "posts"));
    }

    public function orders(){
        $orders = Order::whereNotNull("payment_id")->with("products")->paginate();

        return view("admin.orders", compact("orders"));
    }

    public function complete(Order $order){
        $order->completed = true;
        $order->save();

        return redirect()->back();
    }

    public function requests(){
        $requests = Request::whereNotNull("shipping_id")
                            ->orderBy("created_at", "DESC")
                            ->where("status", "!=", "shipping")
                            ->with(["shipping", "designer"])
                            ->paginate();

        return view("admin.requests", compact("requests"));
    }

    public function deliver(Request $request){

        $request->order->start_at = Carbon::now();
        $request->order->save();

        $request->status = "shipping";
        $request->save();

        Session::flash("success", "Order on it's way");

        return redirect()->back();

    }
}
