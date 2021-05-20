<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use App\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chat(Request $request){ // Request model
        $user = Auth::user();

        if($user->type == "customer"){
            return $this->customer($request, $user);
        } else if($user->type == "designer"){
            return $this->designer($request, $user);
        }

    }


    public function designer($request, $user){
        $request->load(["customer", "product"]);
        $messages = $request->messages()
                            ->orderBy("created_at", "ASC")
                            ->with("sender")
                            ->get();

        $requests = Request::where("designer_id", Auth::id())
                                ->orderBy("created_at", "DESC")
                                ->with(["product", "customer"])
                                ->get();
        

        return view("chat.designer", compact("request", "user", "messages", "requests"));
    } 
    
    
    public function customer($request, $user){
        $request->load(["designer", "product"]);
        $messages = $request->messages()
                            ->orderBy("created_at", "ASC")
                            ->with("sender")
                            ->get();

        $requests = Request::where("customer_id", Auth::id())
                                ->orderBy("created_at", "DESC")
                                ->with(["product", "designer"])
                                ->get();
                                

        return view("chat.customer", compact("user", "request", "messages", "requests"));
    }


    public function send(HttpRequest $httpRequest, Request $request){

        $httpRequest->validate([
            "msg" => "required|string",
            "image"  => "nullable|image"
        ]);

        if(in_array($request->status, ["rejected", "canceled", "delivered"])){
            return abort(401);
        }

        if(Auth::id() != $request->customer_id && Auth::id() != $request->designer_id){
            return abort(401);
        }

        $newMessage = new Message();

        $newMessage->msg = $httpRequest->msg;
        $newMessage->file = $httpRequest->image ? $httpRequest->image->store("public/images") : null;
        $newMessage->sender_id = Auth::id();
        $newMessage->request_id = $request->id;


        $newMessage->save();

        $user = Auth::user();

        broadcast(new MessageSent($user, $newMessage, $request))->toOthers();

        return response()->json([
            "success"   => true,
            "message"   => $newMessage
        ]);
    }
}
