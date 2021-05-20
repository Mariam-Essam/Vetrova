<?php

use App\Category;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route("profile");
    }

    $categories = Category::all();
    $users = User::where("type", "designer")
                        ->withCount("followers")
                        ->orderBy("followers_count", "DESC")
                        ->limit(3)
                        ->get();
    $products = Product::orderByRaw("rate_value / rate_number")
                            ->with(["post" => function($q){
                                    $q->with(["category", "user"]);
                                return $q;
                            }])
                            ->limit(4)
                            ->get();

    return view('index', compact("categories", "users", "products"));
})->name("index");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(["middleware" => "auth"], function(){
    Route::get("profile", "UserController@profile")->name("profile");
    Route::post("settings", "UserController@settings")->name("settings");
});

// Categories
// Route::resource("category", "CategoryController", ["only" => ["create", "store", "show"]]);
Route::resource("category", "CategoryController", ["only" => ["create", "store"]]);
Route::put("category", "CategoryController@update")->name("category.update")->middleware("role:admin");

// Types
Route::post("type", "TypeController@store")->name("type.store")->middleware("role:admin");
Route::put("type", "TypeController@update")->name("type.update")->middleware("role:admin");

// Posts
Route::get("post/edit/{post}", "ProductController@edit")->name("post.edit")->middleware("role:admin");
Route::put("post/{post}", "ProductController@update")->name("post.update")->middleware("role:admin");
Route::get("post/{post}", "ProductController@show")->name("post.show")->middleware("role:customer");

Route::get("/explore", "ProductController@explore")->name("explore");

// Products
Route::post("product", "ProductController@store")->name("product.store")->middleware("role:designer");

Route::get("cart", "CartController@checkout")->name("cart.checkout")->middleware("role:customer");
Route::post("cart", "CartController@cart")->name("user.cart")->middleware("role:customer");
Route::delete("cart/{cart}", "CartController@remove")->name("cart.remove")->middleware("role:customer");


// Payment
Route::post("cart/paypal", "CartController@paypal")->name("cart.paypal")->middleware("role:customer");
Route::get("cart/success", "CartController@success")->name("cart.success")->middleware("role:customer");
Route::get("cart/cancel", "CartController@cancel")->name("cart.cancel")->middleware("role:customer");


// Orders
Route::get("orders", "OrderController@show")->name("order.show")->middleware("role:customer");
Route::get("orders/finished", "OrderController@finished")->name("order.finished")->middleware("role:customer");
Route::post("orders/{cartProduct}", "OrderController@rate")->name("product.rate")->middleware("role:customer");


// Follows
Route::get("designer/{user}", "UserController@designerProfile")->middleware("role:customer")->name("profile.designer");
Route::post("follow/{user}", "UserController@follow")->middleware("role:customer")->name("follow.toggle");


// Admin
// Route::get("profile", "AdminController@unActivePosts")->middleware("role:admin")->name("admin.unactive");
Route::get("dashboard/posts/active", "AdminController@activePosts")->middleware("role:admin")->name("admin.active");

Route::get("dashboard/orders/active", "AdminController@activeOrders")->middleware("role:admin")->name("admin.orders");
Route::get("dashboard/orders/complete", "AdminController@completeOrders")->middleware("role:admin")->name("admin.orders.complete");
Route::post("dashboard/complete/{order}", "AdminController@complete")->middleware("role:admin")->name("admin.complete");
Route::get("dashboard/requests", "AdminController@requests")->middleware("role:admin")->name("admin.requests");
Route::post("dashboard/deliver/{request}", "AdminController@deliver")->middleware("role:admin")->name("admin.deliver");


// Requests
Route::get("request", "RequestController@create")->middleware("role:customer")->name("request.create");
Route::post("request", "RequestController@store")->middleware("role:customer")->name("request.store");
Route::put("request", "RequestController@update")->middleware("role:designer")->name("request.update");
Route::get("requests/designer", "RequestController@designer")->middleware("role:designer")->name("request.designer");
Route::get("requests/customer", "RequestController@customer")->middleware("role:customer")->name("request.customer");
Route::post("requests/cancel/{request}", "RequestController@cancel")->middleware("role:customer,designer")->name("request.cancel");
Route::post("requests/reject/{request}", "RequestController@reject")->middleware("role:designer")->name("request.reject");
Route::post("requests/update/{req}", "RequestController@update")->middleware("role:designer")->name("request.update");
Route::post("requests/pay/{request}", "RequestController@payment")->middleware("role:customer")->name("request.payment");
Route::get("reqeusts/payment/success", "RequestController@success")->middleware("role:customer")->name("request.success");
Route::get("reqeusts/deliver/{req}", "RequestController@deliver")->middleware("role:designer")->name("request.deliver");
Route::post("reqeusts/deliver/{req}", "RequestController@storeInfo")->middleware("role:designer")->name("request.storeInfo");

// Chat
Route::get("chat/{request}", "ChatController@chat")->middleware("auth")->name("chat");
Route::post("chat/{request}", "ChatController@send")->middleware("auth")->name("chat.send");