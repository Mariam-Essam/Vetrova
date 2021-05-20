@extends('layouts.layout')

@section("head")
<link rel="stylesheet" href="/css/chatting.css">
@endsection


@section("content")
<div class="chatting">
    <div class="container-fluid parts p-0 m-0 height-100">
        <div class="row height-100">
            <div class="col-12">
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
                                                    <p class="name">{{ $req->designer->name }}</p>
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
            <div class="col-6 part pt-3 pb-5 mb-5 mx-0 px-0 height-100">
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
                                                        <img class="img-fluid" src="{{ $request->designer->profile_pic }}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="contact-info d-block">
                                                    <p class="p-0 m-0">{{ $request->designer->name }}</p>
                                                    @if($request->status == "waiting")
                                                        <span>Waiting for offer</span>
                                                    @elseif($request->status == "shipping")
                                                    <span>The request is delivered</span>
                                                    @elseif($request->status == "accepted")
                                                        @if($request->status == "accepted" && !$request->order->payment_id)
                                                        <span>Waiting for paying</span>
                                                        @else
                                                        <span>Wroking</span>
                                                        @endif
                                                    @else
                                                        <span>The request is {{ $request->status }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="buttons">
                                                @if(in_array($request->status, ["waiting", "accepted"]))
                                                <form action="{{ route("request.cancel", ["request" => $request]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="incomplete text-white btn btn-danger" id="incomplete">Cancel</button>
                                                </form>
                                                @endif
                                                @if($request->status == "accepted" && !$request->order->payment_id)
                                                <form action="{{ route("request.payment", ["request" => $request]) }}" method="POST">
                                                    @csrf
                                                    <button class="finish-request text-white btn btn-primary" id="finish-request">
                                                        <i class="fab fa-paypal"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mess m-0 p-0">
                                <div class="messages messages-cus px-5" id="chat-box">
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
                                    {{-- <div class="sent message">
                                        <div class="image"><img src="images/chatting/12.jpg" alt="" /></div>
                                        <p>
                                            <span>I think about blue.<span>
                                            <span class="file">
                                                <a href="/storage/image/TRc0IQ3ZRB7B8MdvU230qQtyLKYtNmmM5pChFYz3.png" target="_blank">
                                                    <img src="/storage/image/TRc0IQ3ZRB7B8MdvU230qQtyLKYtNmmM5pChFYz3.png">
                                                </a>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="replies message">
                                        <div class="image"><img src="images/chatting/3.jpg" alt="" /></div>
                                        <p>Blue, It's great but I feel red or pink , It would be awesome!</p>
                                    </div> --}}
                                    
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
            <div class="col-3 part pt-3 pb-5 mb-5 mx-0 px-0 height-100">
                <div class="container part3 mt-0 mx-0 mb-5 pb-5 pt-0 px-0 ">
                    <div class="partener-info">
                        <div class="image-status mb-3 mt-5">
                            <div class="image">
                                <img class="img-fluid" src="{{ $request->designer->profile_pic }}" />
                            </div>
                        </div>
                        <div class="info">
                            <p class="name">
                                <a href="{{ route("profile.designer", ["user" => $request->designer_id]) }}">
                                    {{ $request->designer->name }}    
                                </a>
                                </p>
                            @if($request->designer->governorate)
                                <p class="country">{{ $request->designer->governorate }}, Egypt</p>
                            @endif
                            @if($request->designer->about)
                                <p class="description">{{ $request->designer->about }}</p>
                            @endif
                        </div>
                        @if($request->designer->phone || $request->designer->dob)
                        <div class="more-info mt-5">
                            @if($request->designer->phone)
                            <div class="phone">
                                <p class="phone-word d-inline-block mr-3">Phone:</p>
                                <span class="phone-num d-inline-block mr-3">{{ $request->designer->phone }}</span>
                            </div>
                            @endif
                            @if($request->designer->dob)
                            <div class="date-of-birth">
                                <p class="dob-word d-inline-block mr-3">DOB:</p>
                                <span class="dob d-inline-block mr-3">{{ $request->designer->dob }}</span>
                            </div>
                            @endif
                        </div>
                        @endif
                        {{-- <div class="media d-inline-block py-3 my-5">
                            <div class="container">
                                <div class="media-num">
                                    <p>Media(31)</p>
                                </div>
                                <div class="media-photos d-block">
                                    <div class="row mt-2 w-100">
                                        <div class="col-md-4">
                                            <div class="image mr-2"><img class="img-fluid" src="images/chatting/14.jpg"/></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="image mr-2"><img class="img-fluid" src="images/chatting/15.jpg"/></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="image"><img class="img-fluid" src="images/chatting/16.jpg"/></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="show"><button class="btn text-danger">See All  <i class="fas fa-chevron-right ml-2"></i></button></div>
                        </div> --}}
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