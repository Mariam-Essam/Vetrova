@extends("admin.layout")

{{-- ============ Head Section --}}
@section("head")
<link rel="stylesheet" href="/css/order.css">
<style>
@if($active)
.curr{
    color: #333 !important;
    border-bottom: 3px solid #333 !important;
}
@else
.fin{
    color: #333 !important;
    border-bottom: 3px solid #333 !important;
}
@endif
</style>
@endsection

{{-- ============ Content Section --}}
@section("admin-content")

<section class="nav2 my-2">
    <nav class="navbar navbar-expand-lg pt-0 pb-0" style="background-color: transparent; box-shadow: none;">
        <div class="container mt-0 mb-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto navbar-nav">
                    <li class="nav-item">
                        <a class="curr nav-link" href="{{ route("admin.orders") }}">Current</a>
                    </li>
                    <li class="nav-item">
                        <a class="fin nav-link" href="{{ route("admin.orders.complete") }}">Finished</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
<section class="orders mt-4 w-100">
    <div class="current p-4 w-100" id="current">
        <div class="container">
            <div class="row">
                <h5 class="head-name">Current Orders</h5>
                <div class="container w-100">
                    <div class="row w-100">
                        @if($orders->count())
                        @foreach($orders as $order)
                        <div class="col-md-12">
                            <div class="order d-flex justify-content-center align-items-center flex-column my-2 p-3">
                                <div class="row d-flex justify-content-center align-items-center ord">
                                    <div class="col-md-4">
                                        <div class="order-code">
                                            <div class="word code-word"><h4> Order Code: </h4></div>
                                            <div class="value code-value ml-2"><p id="code">{{ $order->id }}</p></div>
                                        </div>
                                        <div class="order-st-date">
                                            <div class="word st-word">Order Date: </div>
                                            <div class="value st-value ml-2"><h5>{{ $order->created_at->format("d/m/y") }}</h5></div>
                                        </div>
                                        <div class="order-fn-date">
                                            <div class="word st-word">Receive Date: </div>
                                            <div class="value st-value ml-2"><h5>{{ $order->finish_at->format("d/m/y") }}</h5></div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 capt">
                                        <div class="progression">
                                            <div class="progression-bar text-center">
                                                @if($order->completed)
                                                <div class="progression-duration bar1 d-flex justify-content-center" style="width: 100%">
                                                    <p class="prog-duration">
                                                        Completed
                                                    </p>
                                                </div>
                                                @else
                                                <div class="progression-duration bar1 d-flex justify-content-center" style="width: {{ $order->progress }}%">
                                                    <p class="prog-duration">
                                                        {{ $order->progress }}%
                                                    </p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 buttn">
                                        <div class="butn float-right">
                                            <button id="arrow-down1" class="arrow-down btn btn-info mr-3 px-2 pt-1">
                                                <i class="fas fa-sort-down rotate"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="container">
                                            <div class="order-items">
                                                <table class="table table-striped items-table table1">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Price</th>
                                                            <th>Size</th>
                                                            <th>Color</th>
                                                            <th>Quantity</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($order->products as $p)
                                                        <tr>
                                                            <td>
                                                                <div class="image">
                                                                    <img class="img-fluid" src="{{ $p->image }}">
                                                                </div>
                                                                <div class="order-type">
                                                                    <p>To Be Added</p>
                                                                </div>
                                                            </td>
                                                            <td>{{ $p->price }} EP</td>
                                                            <td>{{ $p->sizes }}</td>
                                                            <td>{{ $p->color_name }}</td>
                                                            <td>{{ $p->amount }}</td>
                                                            <td>{{ $p->total }} EP</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="col-6">Governorate: {{ $order->governorate ?? "--" }}</div>
                                                    <div class="col-6">Address: {{ $order->address ?? "--" }}</div>
                                                    <div class="col-6">Street: {{ $order->street ?? "--" }}</div>
                                                    <div class="col-6">House Phone: {{ $order->house_number ?? "--" }}</div>
                                                    <div class="col-6">Phone 1: {{ $order->phone1 ?? "--" }}</div>
                                                    <div class="col-6">Phone 2: {{ $order->phone1 ?? "--" }}</div>
                                                </div>
                                                @if($order->completed)
                                                <button class="btn btn-dark" disabled>Complted</button>
                                                @else
                                                <form action="{{ route("admin.complete", ["order" => $order->id]) }}" method="POST" class="my-2">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Complete</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                            @if($active)
                            <h1 class="display-4 text-center">There's no active orders</h1>
                            @else
                            <h1 class="display-4 text-center">There's no un-completed orders</h1>
                            @endif
                        @endif
                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
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