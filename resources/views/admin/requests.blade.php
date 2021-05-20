@extends("admin.layout")

{{-- ============ Head Section --}}
@section("head")
<link rel="stylesheet" href="/css/order.css">
@endsection

{{-- ============ Content Section --}}
@section("admin-content")

<section class="nav2 my-2">
    <nav class="navbar navbar-expand-lg navbar-light pt-0 pb-0">
        <div class="container mt-0 mb-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            </div>
        </div>
    </nav>
</section>
<section class="orders mt-4 w-100">
    <div class="current p-4 w-100" id="current">
        <div class="container">
            <div class="row">
                <h5 class="head-name">Waiting to be delivered</h5>
                <div class="container w-100">
                    <div class="row w-100">
                        @if($requests->count())
                        @foreach($requests as $req)
                        <div class="col-md-12">
                            <div class="order d-flex justify-content-center align-items-center flex-column my-2 p-3">
                                <div class="row d-flex justify-content-center align-items-center ord">
                                    <div class="col-md-4">
                                        <div class="order-code">
                                            <div class="word code-word"><h4> Request Code: </h4></div>
                                            <div class="value code-value ml-2"><p id="code">{{ $req->id }}</p></div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 capt">
                                    </div>
                                    <div class="col-md-3 buttn">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="container">
                                            <div class="order-items">
                                                <div class="row">
                                                    <div class="col-6">Governorate: {{ $req->shipping->governorate ?? "--" }}</div>
                                                    <div class="col-6">Address: {{ $req->shipping->address ?? "--" }}</div>
                                                    <div class="col-6">Street: {{ $req->shipping->street ?? "--" }}</div>
                                                    <div class="col-6">House Phone: {{ $req->shipping->house_number ?? "--" }}</div>
                                                    <div class="col-6">Phone 1: {{ $req->shipping->phone1 ?? "--" }}</div>
                                                    <div class="col-6">Phone 2: {{ $req->shipping->phone2 ?? "--" }}</div>
                                                </div>
                                                <form action="{{ route("admin.deliver", ["request" => $req->id]) }}" method="POST" class="my-2">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Received</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                            <h1 class="display-4 text-center">There's requests yet!</h1>
                        @endif
                        <div class="d-flex justify-content-center">
                            {{ $requests->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



{{-- ============ Content Section --}}
@section("footer")
<script src="/js/order.js"></script>
@endsection