@extends("layouts.layout")


@section("content")

<form action="{{ route("user.cart") }}" method="POST">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
<div class="container my-3">
    <div class="row">
        <div class="col-md-12">
            <div class="order my-3 p-4">
                <div class="row ord">
                    <div class="col-lg-3">
                        <div class="des-order-name">
                            <div class="word name-word">
                                <h4> Designer Name: </h4>
                            </div>
                            <div class="value name-value ml-2">
                                <p>{{ $post->user->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="des-post-type">
                            <div class="word post-type-word">
                                <h4> Post Type: </h4>
                            </div>
                            <div class="value post-type-value ml-2">
                                <p>{{ $post->type ? $post->type->name : "--" }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="des-design-category">
                            <div class="word design-type-word">
                                <h4> Design Category: </h4>
                            </div>
                            <div class="value design-category-value ml-2">
                                <p>
                                    <a href="{{ route("explore") }}?categories[]={{ $post->category_id }}">
                                        {{ $post->category->name }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="des-design-price">
                            <div class="word design-type-word">
                                <h4> Design Price: </h4>
                            </div>
                            <div class="value design-price-value ml-2">
                                <p>{{ $post->price }} EGP</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="des-design-desc">
                            <div class="word design-desc-word">
                                <h4> Description: </h4>
                            </div>
                            <div class="value design-desc-value ml-2">
                                <p>{{ $post->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h5>Sizes: </h5>
                        <div class="container">
                            <table class="table ">
                                <tr>
                                    <th>Color</th>
                                    <th>Small</th>
                                    <th>Medium</th>
                                    <th>Large</th>
                                    <th>X-Large</th>
                                    <th>XX-Large</th>
                                    <th>More</th>
                                </tr>
                                @foreach($post->products as $product)
                                <tr>
                                    <input type="hidden" name="product[{{ $loop->index }}][id]" value="{{ $product->id }}">
                                    <td>
                                        <div class="color">
                                            {{ $product->color_name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="color">
                                            {{ $product->s }}
                                            <input type="number" name="product[{{ $loop->index }}][s]" min="0" max="{{ $product->s }}" value="0" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="color">
                                            {{ $product->m }}
                                            <input type="number" name="product[{{ $loop->index }}][m]" min="0" max="{{ $product->m }}" value="0" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="color">
                                            {{ $product->l }}
                                            <input type="number" name="product[{{ $loop->index }}][l]" min="0" max="{{ $product->l }}" value="0" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="color">
                                            {{ $product->xl }}
                                            <input type="number" name="product[{{ $loop->index }}][xl]" min="0" max="{{ $product->xl }}" value="0" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="color">
                                            {{ $product->xxl }}
                                            <input type="number" name="product[{{ $loop->index }}][xxl]" min="0" max="{{ $product->xxl }}" value="0" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="color">
                                            {{ $product->more }}
                                            <input type="number" name="product[{{ $loop->index }}][more]" min="0" max="{{ $product->more }}" value="0" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <button type="submit" class="btn btn-primary">Add To Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>


@endsection