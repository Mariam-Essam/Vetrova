@extends("layouts.layout")

@section("head")
<link rel="stylesheet" href="/css/chatting.css">
@endsection


@section("content")
@include("layouts.navbar")
<div class="chatting">
    <div class="container-fluid parts p-0 m-0 height-100">
        <div class="row height-100">
            <div class="col-12">
                {{-- ============ Navbar ============ --}}
                @include("layouts.navbar")
            </div>
            <div class="col-3 part pt-3 pb-4 mb-3 mx-0 px-0 height-100">
                <div class="sidepanel height" id="sidepanel">
                    <div class="container height-100">
                        <div class="row height-100">
                            <div class="col-12">
                                <div class="profile mt-4 d-flex justify-content-center">
                                    <div class="image"><img id="profile-img" src="{{ $user->profile_pic }}" class="online" alt="" /></div>
                                    <p class="mt-4">{{ $user->name }}</p> 
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="search m-4" id="search">
                                </div>
                            </div>
                            <div class="col-12 height-100">
                                @foreach($requests as $req)
                                    @if($req->id == $request->id)
                                    <div class="contacts bg-primary px-0 py-3 w-100" id="contacts">
                                    @else
                                    <div class="contacts px-0 py-3 w-100" id="contacts">
                                    @endif
                                        <a href="{{ route("chat", ["request" => $req->id]) }}">
                                            <div class="contact px-3 py-2 my-1">
                                                <div class="image-status">
                                                    <div class="image">
                                                        <img class="img-fluid" src="{{ $req->product->image }}"/>
                                                    </div> 
                                                </div>
                                                <div class="contact-info ml-2">
                                                    <p class="name">{{ $req->customer->name }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9 part pt-3 pb-5 mb-5 mx-0 px-0 height-100">
                <div class="active-chatting mt-0 mx-0 mb-5 pb-5 pt-0 px-0 height-100">
                    <div class="container-fluid pt-0 px-0 pb-3 mt-0 mx-0 mb-5 height-100">
                        <div class="row m-0 p-0 height-100">
                            <div class="col-12 p-0 m-0">
                                <div class="partener px-4 py-1">
                                    <div class="contact-profile">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="image-status">
                                                    <div class="image">
                                                        <img class="img-fluid" src="{{ $request->customer->profile_pic }}" alt="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="contact-info d-block"><p class="p-0 m-0">{{ $request->customer->name }}</p>
                                                    @if($request->status == "waiting")
                                                        <span>Waiting for offer</span>
                                                    @elseif($request->status == "shipping")
                                                    <span>The request is delivered</span>
                                                    @elseif($request->status == "accepted")
                                                        @if($request->order->payment_id)
                                                            <span>Wroking</span>
                                                            @else
                                                            <span>Waiting for paying {{ $request->product->price }}LE</span>
                                                        @endif
                                                    @else
                                                        <span>The request is {{ $request->status }}</span>
                                                    @endif
                                            </div>
                                            </div>
                                            <div class="buttons">
                                                @if($request->status == "accepted" && $request->order->payment_id)
                                                <a href="{{ route("request.deliver", ["req" => $request->id]) }}" class="btn btn-primary">Deliver</a>
                                                @endif
                                                @if($request->status == "waiting")
                                                <form class="form-inline" action="{{ route("request.update", ["req" => $request->id]) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group mt-2">
                                                        <input type="number" name="price" class="form-control" required min="5">
                                                    </div>
                                                    <button type="submit" class="finish-request text-white btn btn-primary" id="finish-request">Accept</button>
                                                </form>
                                                <form class="form-inline" action="{{ route("request.reject", ["request" => $request->id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="incomplete text-white btn btn-danger" id="incomplete">Reject</button>
                                                </form>
                                                @elseif(in_array($request->status, ["accepted", "waiting"]))
                                                <form action="{{ route("request.cancel", ["request" => $request]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="incomplete text-white btn btn-danger" id="incomplete">Cancel</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mess m-0 p-0">
                                <div class="messages messages-des px-5" id="chat-box">
                                    @foreach($messages as $msg)
                                        @if($msg->sender_id == Auth::id())
                                        <div class="sent message">
                                        @else
                                        <div class="replies message">
                                        @endif
                                        <div class="image">
                                            <img src="{{ $msg->sender->profile_pic }}" alt="" /></div>
                                            <p>
                                                <span>{{ $msg->msg }}<span>
                                                @if($msg->file)
                                                <span class="file">
                                                    <a href="{{ $msg->file }}" target="_blank">
                                                        <img src="{{ $msg->file }}">
                                                    </a>
                                                </span>
                                                @endif
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Messeage Bar -->
                            <div class="col-12 m-0 p-0">
                                @if(!in_array($request->status, ["rejected", "canceled", "delivered", "shipping"]))
                                <div class="message-input w-100 p-2">
                                    <!-- Material auto-sizing form -->
                                    <form class="form-group m-0 p-0" id="chatForm" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-11 m-0 p-0">
                                                <div class="in-mess ml-2">
                                                    <div class="lg-form form-lg text-center input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text lg-addon">
                                                                <label for="image">
                                                                    <i class="fa fa-paperclip attachment fa-1x attach" aria-hidden="true"></i>
                                                                </label>
                                                                <input type="file" name="image" id="image" class="d-none">
                                                            </span>
                                                        </div>
                                                        <input name="msg" id="msg" class="input-mess form-control px-2" id="inlineFormInputGroupLG" placeholder="Send a message...." autoComplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 p-0 m-0">
                                        <button id="submit" type="button" class=" btn btn-primary send m-0 py-2 px-3"><i class="fa fa-paper-plane" aria-hidden="true"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section("removeFooter")
@endsection

@section("footer")

@component('chat.script', ["request" => $request, "user" => $user])
@endcomponent

@endsection