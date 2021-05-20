<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Post;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Srmklive\PayPal\Services\ExpressCheckout;
use Omnipay\Omnipay;
use App\Payment;

class CartController extends Controller
{

    public $gateway;
 
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }
 

    // Add product to cart
    public function cart(Request $request){

        $request->validate([
            // "post_id"  => "required|numeric|exists:posts,id",
            "post_id"  => "required|numeric",
            "product" => "array|required",
            // Product sizes
            // "product.*.id"  => "required|numeric|exists:products,id",
            "product.*.id"  => "required|numeric",
            "product.*.s"  => "required|numeric|min:0",
            "product.*.m"  => "required|numeric|min:0",
            "product.*.l"  => "required|numeric|min:0",
            "product.*.xl"  => "required|numeric|min:0",
            "product.*.xxl"  => "required|numeric|min:0",
            "product.*.more"  => "required|numeric|min:0",
        ]);

        
        foreach($request->product as $p){
            if($p['s'] + $p['m'] + $p['l'] + $p['xxl'] + $p['xxl'] + $p['more'] == 0) continue;

            $oldProduct = Product::find($p['id']);

            $cartProduct = new Cart();

            $cartProduct->price = Post::find($request->post_id)->price;

            $cartProduct->path = $oldProduct->path;
            $cartProduct->color = $oldProduct->color;
            $cartProduct->color_name = $oldProduct->color_name;
            $cartProduct->s = $p['s'];
            $cartProduct->m = $p['m'];
            $cartProduct->l = $p['l'];
            $cartProduct->xl = $p['xl'];
            $cartProduct->xxl = $p['xxl'];
            $cartProduct->more = $p['more'];
            $cartProduct->product_id = $p['id'];
            $cartProduct->customer_id = Auth::id();


            $oldProduct->s -= $p['s'];
            $oldProduct->m -= $p['m'];
            $oldProduct->l -= $p['l'];
            $oldProduct->xl -= $p['xl'];
            $oldProduct->xxl -= $p['xxl'];
            $oldProduct->more -= $p['more'];


            if( $oldProduct->s < 0
                || $oldProduct->m < 0
                || $oldProduct->l < 0
                || $oldProduct->xl < 0
                || $oldProduct->xxl < 0
                || $oldProduct->more < 0 ) {
                    return redirect()->back()->withErrors(["msg" => "Invalid amount number"]);
                }

            // $oldProduct->save();

            $cartProduct->user_id = Auth::id();

            $cartProduct->save();
        }

        Session::flash("success", "The products added successfully to your cart");
    
        return redirect()->route("cart.checkout");
    }

    /**
     * Remove product from the cart
     */
    public function remove(Cart $cart){
        if($cart->user_id != Auth::id()){
            return abort(401);
        } 


        $cart->delete();

        Session::flash("success", "Product removed from the cart");

        return redirect()->back();


    }

    /**
     * Checkout the cart orders
     */
    public function checkout(){

        $user = Auth::user();
        $products = $user->products()->whereNull("order_id")->get();

        $total = 0;
        
        foreach($products as $p){
            $total += $p->total;
        }

        return view("post.checkout", compact("products", "user", "total"));
    }


    /**
     * Pay with paypal
     */
    public function paypal(Request $request){

        $request->validate([
            "fname" => "required|string|min:3|max:20",
            "lname" => "required|string|min:3|max:20",
            "governorate" => "required|string|min:3|max:20",
            "street" => "required|string|min:5",
            "address" => "required|string|min:15",
            "house_number" => "nullable|string|min:8",
            "phone1" => "required|string|min:8",
            "phone2" => "nullable|string|min:8",
            "shipping" => "required|numeric",
        ]);

        $user = Auth::user();
        $products = $user->products()->whereNull("order_id")->get();

        if($products->count() <= 0){
            return redirect()->back()->withErrors(["msg" => "Can't do this action"]);
        }

        if($request->shipping == 1){
            $fees = 100;
        } else if ($request->shipping == 3){
            $fees = 50;
        } else {
            $request->shipping = 7;
            $fees = 25;
        }

        // Create new order
        $order = new Order();

        $order->fname = $request->fname;
        $order->lname = $request->lname;
        $order->governorate = $request->governorate;
        $order->street = $request->street;
        $order->address = $request->address;
        $order->house_number = $request->house_number;
        $order->phone1 = $request->phone1;
        $order->phone2 = $request->phone2;
        $order->shipping = $request->get('shipping');
        $order->user_id = Auth::id();
        $order->save();
        
        $totalPrice = 0;
        $amount = 0;

        foreach($products as $p){
            $totalPrice += $p->total;
            $amount += $p->amount;
            $p->order_id = $order->id;
            $p->save();
        }

        $response = $this->gateway->purchase(array(
            'amount' => $totalPrice + $fees,
            'currency' => env('PAYPAL_CURRENCY'),
            'returnUrl' => route('cart.success'),
            'cancelUrl' => route('cart.cancel'),
        ))->send();

        Session::flash("order_id", $order->id);

        $response->redirect();
    }


    /**
     * Payment success
     */
    public function success(Request $request){
        if(!Session::has("order_id")){
            return abort(404);
        }

        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
            
            if ($response->isSuccessful()){
                // The customer has successfully paid.
                $arr_body = $response->getData();
                
                    // Insert transaction data into the database
                    $user = Auth::user();
                    $order = $user->orders()->where("id", Session::get("order_id"))->first();

                    $payment = new Payment;
                    $payment->payment_id = $arr_body['id'];
                    $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                    $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                    $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                    $payment->currency = env('PAYPAL_CURRENCY');
                    $payment->payment_status = $arr_body['state'];
                    $payment->save();

                    
                    
                    $order->payment_id = $payment->id;
                    $order->save();
                    
                    // Reduce proeduct quantity
                    $products = $order->products;

                    foreach($products as $product){
                        $p = Product::find($product->product_id);

                        $p->s -= $product->s;
                        $p->m -= $product->m;
                        $p->l -= $product->l;
                        $p->xl -= $product->xl;
                        $p->xxl -= $product->xxl;
                        $p->more -= $product->more;

                        $p->s = $p->s  < 0 ? 0 : $p->s;
                        $p->m = $p->m  < 0 ? 0 : $p->m;
                        $p->l = $p->l  < 0 ? 0 : $p->l;
                        $p->xl = $p->xl  < 0 ? 0 : $p->xl;
                        $p->xxl = $p->xxl  < 0 ? 0 : $p->xxl;
                        $p->more = $p->more  < 0 ? 0 : $p->more;

                        $p->save();
                    }


                    Session::flash("success", "Payment is successful. Your transaction id is: ". $arr_body['id']);

                return redirect()->route("order.show");
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }


    /**
     * Payment cancel
     */
    public function cancel(){
        dd("Payment Canceld");
    }


    
}
