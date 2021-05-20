@extends("layouts.layout")

@section("head")
<link rel="stylesheet" href="/css/request-designer.css">
@endsection

@section("content")
        <section class="nav2 my-2">
            @include("layouts.navbar")
        </section>
        <section class="requests mt-4 w-100">
            <div class="pendding p-4 w-100" id="pendding">
                <div class="container">
                    <div class="row">
                        <h5 class="head-name">Pendding Requests</h5>
                        <div class="container w-100">
                            <div class="row w-100">
                                @if($requests->count() == 0)
                                    <h1 class="text-center col-12">You have no requests yet!</h1>
                                @else
                                @foreach($requests as $req)
                                <div class="col-md-12">
                                    <div class="request d-flex justify-content-center align-items-center flex-column my-2 p-3">
                                        
                                        <div class="row  d-flex justify-content-center align-items-center req">
                                            <div class="col-md-3">
                                                <div class="designer">
                                                    <div class="image">
                                                        <img class="img-fluid" src="{{ $req->product->image }}">
                                                    </div>
                                                    <div class="designer-name">
                                                        <p>{{ $req->customer->name }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 capt">
                                                <div class="caption">
                                                    @if($req->status == "waiting")
                                                        <p>Your request is still pendding....</p>
                                                    @elseif($req->status == "shipping")
                                                    <span>The request is delivered</span>
                                                    @elseif($req->status == "accepted")
                                                        @if($req->order->payment_id)
                                                        <p>The request is accepted</p>
                                                        @else
                                                        <p>Waiting for payment {{ $req->product->price }} LE</p>
                                                        @endif
                                                    @else 
                                                        <p>The request is {{ $req->status }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-5 buttn">
                                                <div class="butn float-right">
                                                    <a href="{{ route("chat", ["request" => $req]) }}" class="btn btn-info mr-3">
                                                        Show Request
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="d-flex justify-content-center">
                                    {{ $requests->links() }}
                                </div>
                                @endif
        </section>
@endsection

@section("footer")
<script src="/js/request-designer.js"></script>
@endsection