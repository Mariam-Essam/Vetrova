@extends("layouts.layout")

{{-- ============ Head Section ============ --}}
@section("head")
<link rel="stylesheet" href="/css/order.css">
<style>
.fin{
    color: #333;
    border-bottom: 3px solid #333;
}
</style>
@endsection


{{-- ============ Content Section ============ --}}
@section("content")

{{-- Navbar --}}
@include("layouts.navbar")

<section class="nav2 my-2">
    <nav class="navbar navbar-expand-lg pt-0 pb-0" style="background-color: transparent; box-shadow: none;">
        <div class="container mt-0 mb-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto navbar-nav">
                    <li class="nav-item">
                        <a class="curr nav-link" href="{{ route("order.show") }}">Current</a>
                    </li>
                    <li class="nav-item">
                        <a class="fin nav-link" href="{{ route("order.finished") }}">Finished</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
<section class="orders mt-4 w-100">
    
    <div class="finished p-4 w-100" id="finished">
        <div class="container">
            <div class="row">
                <h5 class="head-name">Finished Orders</h5>
                <div class="container w-100">
                    <div class="row w-100">
                        @if($orders->count())
                        @foreach($orders as $order)
                        <div class="col-md-12">
                            <div class="order d-flex justify-content-center align-items-center flex-column my-2 p-3">
                                <div class="row  d-flex justify-content-center align-items-center ord">
                                    <div class="col-md-4">
                                        <div class="order-code">
                                            <div class="word code-word"><h4> Order Code: </h4></div>
                                            <div class="value code-value ml-2"><p id="code">{{ $order->id }}</p></div>
                                        </div>
                                        <div class="order-st-date">
                                            <div class="word st-word">Order Date: </div>
                                            <div class="value st-value ml-2"><h5>{{ $order->created_at->format("m/d/y") }}</h5></div>
                                        </div>
                                        <div class="order-fn-date">
                                            <div class="word st-word">Receive Date: </div>
                                            <div class="value st-value ml-2"><h5>{{ $order->finish_at->format("d/m/y") }}</h5></div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 capt">
                                        <div class="progression">
                                            <div class="progression-bar"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 buttn">
                                        <div class="butn float-right">
                                            <button id="arrow-down5" class="arrow-down btn btn-info mr-3 px-2 pt-1">
                                            <i class="fas fa-sort-down rotate"></i>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="container">
                                            <div class="order-items">
                                                <table class="table table-striped items-table table5">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Price</th>
                                                            <th>Size</th>
                                                            <th>Color</th>
                                                            <th>Quantity</th>
                                                            <th>Total</th>
                                                            <th>Review</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($order->products as $p)
                                                        <tr>
                                                            <td>
                                                                <div class="image">
                                                                    <img class="img-fluid" src="{{ $p->image }}">
                                                                </div>
                                                            </td>
                                                            <td>{{ $p->price }} EP</td>
                                                            <td>{{ $p->sizes }}</td>
                                                            <td>{{ $p->color_name }}</td>
                                                            <td> {{ $p->amount }} </td>
                                                            <td>{{ $p->total }} EP</td>
                                                            <td>
                                                                @if($p->rated)
                                                                <div class="star">
                                                                    @for($i = 1; $i <= 5; $i++)
                                                                    @if($i <= $p->rate)
                                                                    <i data-value="{{ $i }}" style="color: #df0" class="fas fa-star star1 fa-2x"></i>
                                                                    @else
                                                                    <i data-value="{{ $i }}" class="fas fa-star star1 fa-2x"></i>
                                                                    @endif
                                                                    @endfor
                                                                </div>
                                                                
                                                                @else
                                                                <form action="{{ route("product.rate", ["cartProduct" => $p->id]) }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="rate" class="star-input" id="input{{ $p->id }}" value="1">
                                                                    
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <div class="star">
                                                                        <i data-star="#input{{ $p->id }}" data-value="{{ $i }}" style="color: #df0" class="fas fa-star star1 fa-2x data-star"></i>
                                                                    </div>
                                                                @endfor
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                </form>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <h1 class="display-4 text-center">There's no completed orders</h1>
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



{{-- ============ Content Section ============ --}}
@section("footer")
<script src="/js/order.js"></script>
<script>



    $(".curr").css({color:"#333",borderBottom:"none"});
    $(".fin").css({color:"#333",borderBottom:"3px solid #333"})
    $(".current").hide();
    $(".finished").show();
    setTimeout(()=>{
        // Start
       $(".data-star").click(function(){
            const input = $(this.getAttribute("data-star"));
            const value = this.getAttribute("data-value");
            input.val(value);

            input.parent().parent().find(".data-star").each((index, ele)=>{
                console.log(ele);
                if(value >= index + 1){
                    ele.style.color = "#df0";
                } else {
                    ele.style.color = "#fff";
                }
            })
       });
       
       
       


    }, 500)

   

</script>
@endsection