<div class=" p-5 my-3 w-100 bg-light ml-5">
    <div class="post-info">
        <div class="designer-photo">
            <img class="img-fluid" src="{{ $p->user->profile_pic }}" />
        </div>
        @if($cart)
        <a href="{{ route("profile.designer", ["user" => $p->user_id]) }}">
            <p class="pl-3 d-inline">{{ $p->user->name }}</p>
        </a>
        @else
        <p class="pl-3 d-inline">{{ $p->user->name }}</p>
        @endif
        <div class="d-block">
            <p class="text-muted">{{ $p->created_at->diffForHumans() }}</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="category info-head">
                        <h5 class="d-inline">Category: </h5>
                        <a href="{{ route("explore") }}?categories[]={{ $p->category_id }}">
                            <span class="d-inline ml-3">{{ $p->category->name }}</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    @if($p->type)
                    <div class="type info-head">
                        <h5 class="d-inline">Type:</h5>
                        <span class="d-inline ml-3">{{ $p->type->name }}</span>
                    </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="num info-head">
                        <h5 class="d-inline">no of pieces: </h5>
                        <span class="d-inline ml-3">{{ $p->amount }}</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="desc info-head">
                        <h5 class="d-inline">Description:</h5>
                        <span class="d-inline ml-3">{{ $p->description }}</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="desc info-head">
                        <h5 class="d-inline">Post Number:</h5>
                        <span class="d-inline ml-3">#{{ $p->id }}</span>
                    </div>
                </div>
                {{-- <div class="col-md-12">
                    <div class="in-stock info-head">
                        <h5 class="d-inline">In Stock:</h5>
                        <span class="d-inline ml-3">False</span>
                    </div>
                </div> --}}
                <div class="col-md-12 info-head">
                    <h5>Sizes: </h5>
                    <div class="container">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Color</th>
                                    <th>Small</th>
                                    <th>Medium</th>
                                    <th>Large</th>
                                    <th>X-Large</th>
                                    <th>XX-Large</th>
                                    <th>More</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($p->products as $product)
                                <tr>
                                    <td>
                                        {{ $product->color_name }}
                                    </td>
                                    <td>
                                        <div class="color">
                                            <span class="d-inline ml-2">{{ $product->s }} </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="color">
                                            <span class="d-inline ml-2">{{ $product->m }} </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="color">
                                            <span class="d-inline ml-2">{{ $product->l }} </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="color">
                                            <span class="d-inline ml-2">{{ $product->xl }} </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="color">
                                            <span class="d-inline ml-2">{{ $product->xxl }} </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="color">
                                            <span class="d-inline ml-2">{{ $product->more }} </span>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="col-md-12 info-head">
                    <h5 class="d-inline">Rate: </h5>
                    <div class="stars d-inline">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="post-image w-100 d-flex-justify-content-center flex-column w-75">
        <div class="post-image w-100 d-flex justify-content-center flex-column w-75">
            <div class="big-image d-flex justify-content-center">
                <div class="img-big">
                    <img class="img-fluid big-img"
                        src="{{ Storage::url($p->products->get(0)['path']) }}">
                </div>
                @if($p->products->count() > 1)
                <div class="img-container ">
                    <div class="prev float-right">
                        <i id="prev" class="fas fa-2x fa-arrow-alt-circle-left"></i>
                    </div>
                    <div class="next float-left">
                        <i id="next" class="fas fa-2x fa-arrow-alt-circle-right"></i>
                    </div>
                </div>
                @endif
            </div>
            <div class="small-image w-100 d-flex justify-content-center mt-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="small-images w-100 d-flex justify-content-center">
                                @if($p->products->count() > 1)
                                @foreach($p->products as $product)
                                <div class="img-small">
                                    <img class="img-fluid small-img small-img1"
                                        src="{{ Storage::url($product->path) }}">
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($cart)
        <div class="add-to-cart">
            <a href="{{ route("post.show", ["post" => $p->id]) }}">
                <button class="btn btn-info">
                    Add To My Cart
                </button>
            </a>
        </div>
        @endif
    </div>
</div>