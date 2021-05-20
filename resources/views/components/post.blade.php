<div class="col-md-4">
    <div class="product m-2">
        <a class="portfolio-link" href="" data-toggle="modal" data-target="#product{{ $p->id }}">
            <div class="image rounded overflow-hidden">
                <img class="w-100 img-fluid" src="{{ Storage::url($p->products->get(0)['path']) }}">
            </div>
            <div class="product-info p-3 text-center">
                <div class="rating-wrapper pb-2"><i class="far fa-star"></i>
                    <i class="far fa-star"></i><i class="far fa-star"></i>
                    <i class="far fa-star"></i><i class="far fa-star"></i>
                </div>
                <div class="product-type pb-2">
                    @if($p->type)
                    <p>{{ $p->type->name }}</p>
                    @endif
                </div>
                <div class="product-price pb-2">
                    <p class="price">{{ $p->price }}</p>
                    <span class="currency">L.E</span>
                </div>
            </div>
        </a>
    </div>
</div>
<!-- modal body  -->
<!-- Modal 1 -->
<div class="modal w-100 fade" id="product{{ $p->id }}" tabindex="1" role="dialog">
    <div class="modal-dialog modal-lg w-100 m-auto" role="document">
        <div class="modal-content w-100">
            <div id="close" data-dismiss="modal">
                <i class="fa fa-2x fa-window-close"></i>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 small-images">
                        <div class="row">
                            @foreach($p->products as $product)
                            <div class="col-md-12 my-4">
                                <div class="sub-image w-100">
                                    <img class="sub-img my-0 p-0 mx-2 img-fluid"
                                        src="{{ Storage::url($product->path) }}">
                                        <div class="bg-white text-black">
                                            {{ $product->color . ' ' . $product->size }}
                                        </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="modal-body w-100 py-5">
                            <div
                                class="image w-100 my-4 d-flex align-items-center justify-content-between">
                                <div class="big-image w-100 my-0 py-0">
                                    <img class="main-img img-fluid" id="img{{ $product->id }}"
                                        src="{{ Storage::url($p->products->get(0)['path']) }}">
                                </div>
                                @if($p->products->count() > 1)
                                <div class="img-container ">
                                    <div class="prev float-right"><i id="prev"
                                            class="fas fa-2x fa-arrow-alt-circle-left"></i>
                                    </div>
                                    <div class="next float-left"><i id="next"
                                            class="fas fa-2x fa-arrow-alt-circle-right"></i>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="prod-info w-100 prod-info-2">
                                @if(Auth::check() && Auth::id() == $p->user_id)
                                <div>
                                    @if($p->active)
                                    <div class="badge badge-success">Active</div>
                                    @else
                                    <div class="badge badge-warning">In-active</div>
                                    @endif
                                </div>
                                @endif
                                <div>
                                    <p>Designer Name: </p>
                                    <span> 
                                        @if(Auth::check() && Auth::user()->type != "designer")
                                        <a href="{{ route("profile.designer", ["user" => $p->user_id]) }}">
                                            {{ $p->user->name }}
                                        </a>
                                        @else
                                            {{ $p->user->name }}
                                        @endif
                                    </span>
                                </div>
                                <div>
                                    <p>category: </p>
                                    <span> {{ $p->category->name }}</span>
                                </div>
                                <div>
                                    <p>Fabric: </p>
                                    <span> Lace</span>
                                </div>
                                <div>
                                    <p>Price: </p>
                                    <span> {{ $p->price }}</span>
                                </div>
                                <div>
                                    @auth
                                    @if(Auth::user()->type == "admin")
                                    <a href="{{ route("post.edit", ["post" => $p->id] ) }}" class="btn btn-primary">
                                        Edit
                                    </a>
                                    @elseif(Auth::user()->type == "customer")
                                    <a href="{{ route("post.show", ["post" => $p->id]) }}" class="btn btn-success">
                                        Order
                                    </a>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>