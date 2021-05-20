@extends('layouts.layout')

{{-- ================= Head Section ================= --}}
@section("head")
<link rel="stylesheet" href="/css/designerprofile-customerview.css">
@endsection


{{-- ================= Content Section ================= --}}
@section("content")
<!-- ////////////////////  Upbutton  /////////////////////// -->
<button class="btn btn-info upButton"><i class="fas fa-chevron-circle-up"></i></button>
<div class="container-fluid w-100 m-0 p-0">
    <div class="row p-0 m-0">
        <div class="col-lg-10 p-0 m-0">
            <!--////////////////////////////navbar///////////////////////////////////-->
            @include("layouts.navbar")
            <!--/////////////////////////Designer Information////////////////////////// -->
            <div class="container-fluid p-0 m-0">
                <div class="row m-0 p-0">
                    <div class="col-3 m-0 p-0">
                        <div class="information">
                            <div class="designer-info d-flex text-center flex-column px-4 pb-5">
                                <div class="info">
                                    <div class="profile mt-5 d-flex justify-content-center align-items-center text-center flex-column">
                                        <div class="image"><img id="profile-img" src="{{ $designer->profile_pic }}" class="m-0 p-0" alt="" /></div>
                                        <p class="my-3 text-center">{{ $designer->name }}</p> 
                                    </div>
                                    @if($designer->governorate)
                                    <div class="country"><p class="text-muted">{{ $designer->governorate }}, Egypt</p></div>
                                    @endif
                                    <div class="follow-btn mb-3 d-flex justify-content-center">
                                        <form action="{{ route("follow.toggle", ["user" => $designer->id]) }}" method="POST">
                                            @csrf
                                            @if($followed)
                                            <button type="submit" class="btn btn-danger py-2 px-3 m-3">Unfollow</button>
                                            @else
                                            <button type="submit" class="btn btn-primary py-2 px-3 m-3">Follow</button>
                                            @endif
                                        </form>
                                    </div>
                                    <div class="followers">
                                        <h5>Followers</h5>
                                        <p>{{ $numberOfFollowers }}</p>
                                    </div>
                                    @if($designer->about)
                                    <div class="desc">
                                        <h5>Description</h5>
                                        <p>{{ $designer->about }}</p>
                                    </div>
                                    @endif
                                </div>
                                @if($designer->phone || $designer->dob)
                                <div class="more-info mt-3">
                                    @if($designer->phone)
                                    <div class="phone">
                                        <p class="phone-word d-inline-block mr-3">Phone:</p>
                                        <span class="phone-num d-inline-block mr-3">{{ $designer->phone }}</span>
                                    </div>
                                    @endif
                                    @if($designer->dob)
                                    <div class="date-of-birth">
                                        <p class="dob-word d-inline-block mr-3">DOB:</p>
                                        <span class="dob d-inline-block mr-3">{{ $designer->dob }}</span>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
<!--///////////////////////////////////////Posts column /////////////////////////////////////// -->
                    <div class="col-8 d-flex justify-content-center flex-column">
                        <div class="container">
                            <div class="row">
                                <div class="buttons m-3 d-flex justify-content-center">
                                    <a href="{{ route("request.create") }}" class="btn btn-info py-2 px-3 m-3">Create New Request</a>
                                </div>
                            </div>
                        </div>
                        @if($posts->count())
                            @foreach($posts as $p)
                                @component('post.post', ["p" => $p, "cart" => true])
                                    
                                @endcomponent
                            @endforeach
                        @else
                        <h1 class="text-center dispaly-4">No Posts</h1>
                        @endif
                    <div class="d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                </div>
                
            </div>
            </div>
        </div>
        <div class="col-2 p-0 m-0">
            <div class="messages-side">
                <div class="messages-head py-3 px-4 bg-info">
                   <i class="fas fa-envelope text-white"></i><p class="d-inline"> Online Messages</p> 
                </div>
                <div class="contacts px-1 mr-2 py-0" id="contacts">
                    @foreach($requests as $req)
                        <div class="contacts px-0 py-3 w-100" id="contacts">
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
<!-- Add to cart Modal -->
<div class="modal addcart-modal w-100 fade" id="add-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg w-100 m-auto" role="document">
        <div class="modal-content p-5">
            <div id="close" data-dismiss="modal"><i class="fas fa-times fa-2x"></i></div>
            <div class="d-flex justify-content-center">
                <div class="image-cart">
                    <img class="img-fluid" src="images/designer-profile/2.jpg">
                </div>
            </div>
            <form>
                <div class="my-4 col-md-12">
                    <label>Sizes:</label>
                    <div class="form-check d-inline ml-3">
                        <input class="form-check-input small-check" name="size" type="checkbox" value="" id="small">
                        <label class="form-check-label" for="small">
                            Small
                        </label>
                    </div>
                    <div class="form-check d-inline ml-3">
                        <input class="form-check-input medium-check" name="size" type="checkbox" value="" id="medium">
                        <label class="form-check-label medium" for="medium">
                            Medium
                        </label>
                    </div>
                    <div class="form-check d-inline ml-3">
                        <input class="form-check-input large-check" name="size" type="checkbox" value="" id="large">
                        <label class="form-check-label" for="large">
                            Large
                        </label>
                    </div>
                    <div class="form-check d-inline ml-3">
                        <input class="form-check-input xlarge-check" name="size" type="checkbox" value="" id="x-large">
                        <label class="form-check-label xlarge-check" for="x-large">
                            X-large
                        </label>
                    </div>
                    <div class="form-check d-inline ml-3">
                        <input class="form-check-input xxlarge-check" name="size" type="checkbox" value="" id="xx-large">
                        <label class="form-check-label xxlarge-check" for="xx-large">
                            XX-large
                        </label>
                    </div>
                    <div class="form-check d-inline ml-3">
                        <input class="form-check-input more-check" name="size" type="checkbox" value="" id="more">
                        <label class="form-check-label more-check" for="more">
                            more
                        </label>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 pb-3">
                            <div class="small-info">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="small-word"><h5>Small: </h5></div>
                                            <input class="color-check-input red-check" name="size" type="checkbox" value="" id="small-red">
                                            <lable class="pb-3" for="small-color-num"><button class="colorRed"></button>
                                            </lable>
                                            <input class="color-check-input blue-check" name="size" type="checkbox" value="" id="small-blue">
                                            <button class="colorBlue"></button>
                                            <input class="color-check-input black-check" name="size" type="checkbox" value="" id="small-black">
                                            <button class="colorBlack"></button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 small-red-num">
                                                    <lable class="red-num">Number of pieces for red color</lable>
                                                    <select class="form-control color-number" type="number" id="small-red-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 small-blue-num">
                                                    <lable class="blue-num">Number of pieces for blue color</lable>
                                                    <select class="form-control color-number" type="number" id="small-blue-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 small-black-num">
                                                    <lable class="black-num">Number of pieces for black color</lable>
                                                    <select class="form-control color-number" type="number" id="small-black-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pb-3">
                            <div class="medium-info">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="medium-word"><h5>Medium: </h5></div>
                                            <input class="color-check-input red-check" name="size" type="checkbox" value="" id="medium-red">
                                            <lable class="pb-3" for="medium-color-num"><button class="colorRed"></button>
                                            </lable>
                                            <input class="color-check-input blue-check" name="size" type="checkbox" value="" id="medium-blue">
                                            <button class="colorBlue"></button>
                                            <input class="color-check-input black-check" name="size" type="checkbox" value="" id="medium-black">
                                            <button class="colorBlack"></button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 medium-red-num">
                                                    <lable class="red-num">Number of pieces for red color</lable>
                                                    <select class="form-control color-number" type="number" id="medium-red-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 medium-blue-num">
                                                    <lable class="blue-num">Number of pieces for blue color</lable>
                                                    <select class="form-control color-number" type="number" id="medium-blue-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 medium-black-num">
                                                    <lable class="black-num">Number of pieces for black color</lable>
                                                    <select class="form-control color-number" type="number" id="medium-black-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pb-3">
                            <div class="large-info">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="large-word"><h5>Large: </h5></div>
                                            <input class="color-check-input red-check" name="size" type="checkbox" value="" id="large-red">
                                            <lable class="pb-3" for="large-color-num"><button class="colorRed"></button>
                                            </lable>
                                            <input class="color-check-input blue-check" name="size" type="checkbox" value="" id="large-blue">
                                            <button class="colorBlue"></button>
                                            <input class="color-check-input black-check" name="size" type="checkbox" value="" id="large-black">
                                            <button class="colorBlack"></button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 large-red-num">
                                                    <lable class="red-num">Number of pieces for red color</lable>
                                                    <select class="form-control color-number" type="number" id="large-red-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 large-blue-num">
                                                    <lable class="blue-num">Number of pieces for blue color</lable>
                                                    <select class="form-control color-number" type="number" id="large-blue-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 large-black-num">
                                                    <lable class="black-num">Number of pieces for black color</lable>
                                                    <select class="form-control color-number" type="number" id="large-black-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pb-3">
                            <div class="xlarge-info">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="xlarge-word"><h5>X-large: </h5></div>
                                            <input class="color-check-input red-check" name="size" type="checkbox" value="" id="xlarge-red">
                                            <lable class="pb-3" for="xlarge-color-num"><button class="colorRed"></button>
                                            </lable>
                                            <input class="color-check-input blue-check" name="size" type="checkbox" value="" id="xlarge-blue">
                                            <button class="colorBlue"></button>
                                            <input class="color-check-input black-check" name="size" type="checkbox" value="" id="xlarge-black">
                                            <button class="colorBlack"></button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 xlarge-red-num">
                                                    <lable class="red-num">Number of pieces for red color</lable>
                                                    <select class="form-control color-number" type="number" id="xlarge-red-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 xlarge-blue-num">
                                                    <lable class="blue-num">Number of pieces for blue color</lable>
                                                    <select class="form-control color-number" type="number" id="xlarge-blue-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 xlarge-black-num">
                                                    <lable class="black-num">Number of pieces for black color</lable>
                                                    <select class="form-control color-number" type="number" id="xlarge-black-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pb-3">
                            <div class="xxlarge-info">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="xxlarge-word"><h5>XX-large: </h5></div>
                                            <input class="color-check-input red-check" name="size" type="checkbox" value="" id="xxlarge-red">
                                            <lable class="pb-3" for="xxlarge-color-num"><button class="colorRed"></button>
                                            </lable>
                                            <input class="color-check-input blue-check" name="size" type="checkbox" value="" id="xxlarge-blue">
                                            <button class="colorBlue"></button>
                                            <input class="color-check-input black-check" name="size" type="checkbox" value="" id="xxlarge-black">
                                            <button class="colorBlack"></button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 xxlarge-red-num">
                                                    <lable class="red-num">Number of pieces for red color</lable>
                                                    <select class="form-control color-number" type="number" id="xxlarge-red-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 xxlarge-blue-num">
                                                    <lable class="blue-num">Number of pieces for blue color</lable>
                                                    <select class="form-control color-number" type="number" id="xxlarge-blue-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 xxlarge-black-num">
                                                    <lable class="black-num">Number of pieces for black color</lable>
                                                    <select class="form-control color-number" type="number" id="xxlarge-black-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pb-3">
                            <div class="moresize-info">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="more-word"><h5>More: </h5></div>
                                            <input class="color-check-input red-check" name="size" type="checkbox" value="" id="more-red">
                                            <lable class="pb-3" for="more-color-num"><button class="colorRed"></button>
                                            </lable>
                                            <input class="color-check-input blue-check" name="size" type="checkbox" value="" id="more-blue">
                                            <button class="colorBlue"></button>
                                            <input class="color-check-input black-check" name="size" type="checkbox" value="" id="more-black">
                                            <button class="colorBlack"></button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 more-red-num">
                                                    <lable class="red-num">Number of pieces for red color</lable>
                                                    <select class="form-control color-number" type="number" id="more-red-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 more-blue-num">
                                                    <lable class="blue-num">Number of pieces for blue color</lable>
                                                    <select class="form-control color-number" type="number" id="more-blue-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 more-black-num">
                                                    <lable class="black-num">Number of pieces for black color</lable>
                                                    <select class="form-control color-number" type="number" id="more-black-num">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-button d-flex justify-content-center">
                    <button class="btn btn-primary">Add To Cart</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


{{-- ================= Footer Section ================= --}}
@section("footer")
<script src="/js/designerprofile-customerview.js"></script>
@endsection