@extends("layouts.layout")

@section("head")
<link rel="stylesheet" href="/css/request-customer.css">
@endsection

@section("content")

@include("layouts.navbar")
<section class="nav2 my-2">
    <nav class="navbar navbar-expand-lg navbar-light pt-0 pb-0">
        <div class="container mt-0 mb-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </nav>
</section>
<section class="requests mt-4 w-100">
    <div class="pendding p-4 w-100" id="pendding">
        <div class="container">
            <div class="row">
                <div class="container w-100">
                    <div class="row w-100">
                        @if($requests->count() == 0)
                        <h1 class="col-12 text-center">You don't have reqeusts yet!</h1>
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
                                                <p>{{ $req->designer->name }}</p>
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
                                                    <span>Wroking</span>
                                                @else
                                                    <span>Waiting for payment {{ $req->product->price }}LE</span>
                                                @endif
                                            @else
                                                <p>The request is {{ $req->status }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-5 buttn">
                                        <div class="butn float-right">
                                            <a class="btn btn-info" href="{{ route("chat", ["request" => $req->id]) }}">
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
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@section("footer")
<script src="/js/request-customer.js"></script>
@endsection