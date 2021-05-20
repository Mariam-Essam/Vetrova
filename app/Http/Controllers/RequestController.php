<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Order;
use App\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Omnipay\Omnipay;
use App\Payment;
use App\Shipping;

class RequestController extends Controller
{


    public $gateway;
 
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Category::with("types")->get();
        
        $designers = Auth::user()->follows;

        return view("request.create", compact("designers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HttpRequest $request)
    {
        $request->validate([
            "governorate" => "required|string",
            "address" => "required|string",
            "street" => "required|string",
            "phone1" => "required|string",
            "phone2" => "required|string",
            "shipping" => "required|numeric",
            
            // Product
            "color" => "required|string",
            "color_name" => "required|string",
            "image" => "required|image",
            
            // Request
            "description" => "required|string",
            "designer_id" => "required|numeric",
        ]);

        // dd($request->all());

        $user = Auth::user();


        // Crate Order
        $order = new Order();

        $order->fname = $user->fname;
        $order->lname = $user->lname;
        $order->governorate = $request->governorate;
        $order->street = $request->street;
        $order->address = $request->address;
        $order->house_number = "";
        $order->phone1 = $request->phone1;
        $order->phone2 = $request->phone2;
        $order->shipping = $request->get('shipping');
        $order->start_at = null;
        $order->user_id = Auth::id();
        $order->save();

        // Create cart product
        $cartProduct = new Cart();

        $cartProduct->price = 0;
        $cartProduct->path = $request->image->store("public/images");
        $cartProduct->color = $request->color;
        $cartProduct->color_name = $request->color_name;
        $cartProduct->s = 0;
        $cartProduct->m = 0;
        $cartProduct->l = 0;
        $cartProduct->xl = 0;
        $cartProduct->xxl = 0;
        $cartProduct->more = 0;
        $cartProduct->user_id = Auth::id();
        $cartProduct->product_id = 0;
        $cartProduct->order_id = $order->id;
        $cartProduct->customer_id = Auth::id();
        
        $cartProduct->save();

        
        // Create Request
        $newRequest = new Request();
        
        $newRequest->description = $request->description;
        $newRequest->price = 0;
        $newRequest->customer_id = Auth::id();
        $newRequest->designer_id = $request->designer_id;
        $newRequest->product_id = $cartProduct->id;
        $newRequest->order_id = $order->id;
        $newRequest->status = "waiting";

        $newRequest->save();

        Session::flash("success", "Your request is sent successfully");

        return redirect()->route("profile");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(HttpRequest $request, Request $req)
    {
        $request->validate([
            "price" => "required|numeric|min:0"
        ]);

        if($req->designer_id != Auth::id()){
            return redirect()->back();
        }

        $req->product->price = $request->price;
        $req->product->save();

        $req->status = "accepted";
        $req->save();

        Session::flash("success", "The request #" . $req->id . " accepted.");

        return redirect()->back();
    }


    /**
     * Show designer request
     */
    public function designer(){
        $requests = Request::where("designer_id", "=", Auth::id())
                            ->orderBy("created_at", "DESC")
                            ->with(["customer", "product", "order"])
                            ->paginate();

        return view("request.designer", compact("requests"));
    }
   
    /**
     * Show designer request
     */
    public function customer(){
        $requests = Request::where("customer_id", "=", Auth::id())
                            ->orderBy("created_at", "DESC")
                            ->with("designer", "product", "order")
                            ->paginate();

        return view("request.customer", compact("requests"));
    }
    
    /**
     * Cancel the requst if it's in waiting status
     */
    public function cancel(Request $request){
        
        if($request->customer_id != Auth::id() && $request->designer_id != Auth::id()){
            return abort(401);
        }

        if(in_array($request->status, ["waiting", "accepted", "working"])){
            $request->status = "canceled";
            $request->save();

            if($request->order->payment_id){    // Delete the payment
                $payment = Payment::find($request->order->payment_id);
                $payment->delete();
            }
        }
        
        return redirect()->back();
    }


    /**
     * Cancel the requst if it's in reject status
     */
    public function reject(Request $request){
        
        if($request->designer_id == Auth::id() && $request->status == "waiting"){
            $request->status = "rejected";
            $request->save();
        }

        return redirect()->back();
    }


    /**
     * Pay with paypal
     */
    public function payment(Request $request){
        if($request->customer_id != Auth::id()){
            return redirect()->back();
        }
        
        $price = $request->product->price;
        
        if($request->order->shipping == 1){
            $price += 100;
        } else if ($request->order->shipping == 3){
            $price += 50;
        }
        else{
            $price += 25;
        }
        

        $response = $this->gateway->purchase(array(
            'amount' => $price,
            'currency' => env('PAYPAL_CURRENCY'),
            'returnUrl' => route('request.success'),
            'cancelUrl' => route('cart.cancel'),
        ))->send();

        Session::flash("order_id", $request->order->id);

        $response->redirect();
    }


    // Success payment
    public function success(HttpRequest $request){
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
                    
                    Session::flash("success", "Payment is successful. Your transaction id is: ". $arr_body['id']);

                return redirect()->route("request.customer");
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }


    /**
     * Display deliver view
     */
    public function deliver(Request $req){

        return view("chat.deliver", compact("req"));
    }

    /**
     * Store delivery info
     */
    public function storeInfo(HttpRequest $request, Request $req){
        $request->validate([
            "fname" => "required|string",
            "lname" => "required|string",
            "governorate" => "required|string",
            "address" => "required|string",
            "street" => "required|string",
            "house_number" => "nullable|string|min:7",
            "phone1" => "required|string|min:8",
            "phone2" => "nullable|string|min:8",
        ]);
        if($req->shipping_id){
            return redirect()->route("request.designer");
        }

        $shipping = new Shipping();

        $shipping->fname = $request->fname;
        $shipping->lname = $request->lname;
        $shipping->governorate = $request->governorate;
        $shipping->street = $request->street;
        $shipping->address = $request->address;
        $shipping->house_number = $request->house_number;
        $shipping->phone1 = $request->phone1;
        $shipping->phone2 = $request->phone2;

        $shipping->save();
        $req->shipping_id = $shipping->id;
        $req->status = "delivered";
        $req->save();

        Session::flash("success", "Request delivered successfully");

        return redirect()->back();
    }

   
}
