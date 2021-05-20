@extends('layouts.layout')

{{-- ==================== Head ==================== --}}
@section("head")
<link rel="stylesheet" href="/css/designer-profile.css">
@endsection


{{-- ==================== Content ==================== --}}
@section("content")
<!-- ////////////////////  Upbutton  /////////////////////// -->
<button class="btn btn-info upButton"><i class="fas fa-chevron-circle-up"></i></button>
<div class="container-fluid w-100 m-0 p-0">
    <div class="row p-0 m-0">
        <div class="col-lg-10 p-0 m-0">
            <!--////////////////////////////navbar///////////////////////////////////-->
            @include("layouts.navbar")
            <!--///////////////////////////////////////Designer Information/////////////////////////////////// -->
            <div class="container-fluid p-0 m-0">
                <div class="row m-0 p-0">
                    <div class="col-3 m-0 p-0">
                        <div class="information">
                            <div class="designer-info d-flex text-center flex-column px-4 pb-5">
                                <div class="info">
                                    <div
                                        class="profile mt-5 d-flex justify-content-center align-items-center text-center flex-column">
                                        <div class="image"><img id="profile-img" src="{{ $user->profile_pic }}"
                                                class="m-0 p-0" alt="" /></div>
                                        <p class="my-3 text-center">{{ $user->name }}</p>
                                    </div>
                                    @if($user->governorate)
                                    <div class="country">
                                        <p class="text-muted">{{$user->governorate}}, Egypt</p>
                                    </div>
                                    @endif
                                    <div class="followers">
                                        <h5>Followers</h5>
                                        <p>{{ $numberOfFollowers }}</p>
                                    </div>
                                    @if($user->about)
                                    <div class="desc">
                                        <h5>Description</h5>
                                        <p>{{ $user->about }}</p>
                                    </div>
                                    @endif
                                </div>
                                @if($user->phone || $user->dob)
                                <div class="more-info mt-3">
                                    @if($user->phone)
                                    <div class="phone">
                                        <p class="phone-word d-inline-block mr-3">Phone:</p>
                                        <span class="phone-num d-inline-block mr-3">{{ $user->phone }}</span>
                                    </div>
                                    @endif
                                    @if($user->dob)
                                    <div class="date-of-birth">
                                        <p class="dob-word d-inline-block mr-3">DOB:</p>
                                        <span class="dob d-inline-block mr-3">{{ $user->dob }}</span>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--///////////////////////////////////////Posts column /////////////////////////////////////// -->
                    <div class="col-8 d-flex justify-content-center flex-column">
                        <div class="post-design m-5 w-100 d-flex justify-content-certer align-items-center">
                            <div class="post-input w-100 bg-light  p-3 ">
                                <div class="image"><img id="profile-img" src="{{ $user->profile_pic }}"
                                        class="m-0 p-0" alt="" /></div>
                                <p class="d-inline pt-2 pl-4">Post a Design.....</p>
                                <button class="btn post-btn py-2 px-3" data-toggle="modal"
                                    data-target="#create-post">Post</button>
                            </div>
                        </div>
                        <div class="col-12 my-2 ml-4">
                            <a href="{{ route("request.designer") }}" class="btn btn-primary">Requests</a>
                        </div>
                        @foreach($posts as $p)
                            @component('post.post', ["p" => $p, "cart" => false])
                            @endcomponent
                        @endforeach
                        <div class="d-flex justify-content-center">
                            {{ $posts->links() }}
                        </div>
                    </div>

                </div>
                <!-- ////////////////////////footer/////////////////////////////// -->
                
            </div>
        </div>
        <!--///////////////////////////////////////Messages side/////////////////////////////////// -->
        <div class="col-2 p-0 m-0">
            <div class="messages-side">
                <div class="messages-head py-3 px-4 bg-info">
                    <i class="fas fa-envelope text-white"></i>
                    <p class="d-inline"> Online Messages</p>
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
                                        <p class="name">{{ $req->customer->name }}</p>
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
<!-- Window for creating post-->
<div class="modal sign-modal w-100 fade" id="create-post" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg w-100 m-auto" role="document">
        <div class="modal-content p-5">
            <div id="close" data-dismiss="modal"><i class="fas fa-times fa-2x"></i></div>
            <div class="d-flex justify-content-center text-center">
                <h3>Creat Your Post</h3>
            </div>
            <form action="{{ route("product.store") }}" method="POST" enctype="multipart/form-data" id="post-form">
                @csrf
                <div class="clothes">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 py-3">
                                <label for="shipping-governorate">Governorate*</label>
                                <select class="custom-select" name="governorate" id="shipping-governorate" required>
                                    <option selected disabled value="">Governorate</option>
                                    <option value="Alexandria">Alexandria</option>
                                    <option value="Aswan">Aswan</option>
                                    <option value="Asyut">Asyut</option>
                                    <option value="Beheira">Beheira</option>
                                    <option value="Beni Suef">Beni Suef</option>
                                    <option value="Cairo">Cairo</option>
                                    <option value="Dakahlia">Dakahlia</option>
                                    <option value="Damietta">Damietta</option>
                                    <option value="Faiyum">Faiyum</option>
                                    <option value="Gharbia">Gharbia</option>
                                    <option value="Giza">Giza</option>
                                    <option value="Ismailia">Ismailia</option>
                                    <option value="Kafr El Sheikh">Kafr El Sheikh</option>
                                    <option value="Luxor">Luxor</option>
                                    <option value="Matruh">Matruh</option>
                                    <option value="Minya">Minya</option>
                                    <option value="Monufia">Monufia</option>
                                    <option value="New Valley">New Valley</option>
                                    <option value="North Sinai">North Sinai</option>
                                    <option value="Port Said">Port Said</option>
                                    <option value="Qalyubia">Qalyubia</option>
                                    <option value="Qena">Qena</option>
                                    <option value="Red Sea">Red Sea</option>
                                    <option value="Sharqia">Sharqia</option>
                                    <option value="Sohag">Sohag</option>
                                    <option value="South Sinai">South Sinai</option>
                                    <option value="Suez">Suez</option>
                                </select>
                            </div>
                            <div class="col-md-4 py-3">
                                <label for="shipping-street">Street*</label>
                                <input id="shipping-street" name="street" class="form-control" type="text"
                                    placeholder="Street">
                            </div>
                            <div class="col-md-4 py-3">
                                <label for="shipping-address">Address*</label>
                                <input id="shipping-address" name="address" class="form-control" type="text"
                                    placeholder="Address">
                            </div>
                            <div class="col-md-4 py-3">
                                <label for="shipping-houseNum">House Number*</label>
                                <input id="shipping-houseNum" name="house_number" class="form-control" type="text"
                                    placeholder="House Number">
                            </div>
                            <div class="col-md-4 py-3">
                                <label for="shipping-tel1">Telephone Number1*</label>
                                <input id="shipping-tel1" name="phone1" class="form-control" type="text"
                                    placeholder="Telephone Number1">
                            </div>
                            <div class="col-md-4 py-3">
                                <label for="shipping-tel2">Telephone Number2</label>
                                <input id="shipping-tel2" name="phone2" class="form-control" type="text"
                                    placeholder="Telephone Number2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="category">Category*</label>
                                <select class="custom-select" id="category" name="category" required>
                                    <option selected disabled value="">-- Category --</option>
                                    @foreach($categories as $cat)
                                    <option data-category="#cat{{ $cat->id }}" value="{{ $cat->id }}">{{ $cat->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="type">Type*</label>
                                <select class="custom-select" name="type" id="type">
                                    <option selected disabled value="">-- Type --</option>
                                    @foreach($categories as $cat)
                                    <optgroup id="cat{{ $cat->id }}" label="{{ $cat->name }}">
                                        @foreach($cat->types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Price*</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="price" id="price" class="form-control"
                                        aria-label="Amount" placeholder="Price in EP">
                                    <div class="input-group-append">
                                        <span class="input-group-text">EP</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="description">Description*</label>
                                <textarea class="form-control" id="description" placeholder="Description"
                                    name="description" required></textarea>
                            </div>
                            {{-- <div class="mb-3 col-12">
                            <label for="images">Upload images:</label>
                            <input type="file" name="images[]" id="images" multiple>
                        </div> --}}
                            <div class="col-12" id="inputs-container">
                                <div class="mb-3 col-12">
                                    <div class="form-group">
                                        <label>Image*</label>
                                        <input type="file" name="products[0][image]" required>
                                    </div>
                                    <div class="form-group col-12">
                                        {{-- ====================== Sizes ====================== --}}
                                        <h4 class="d-block text-center">Sizes</h4>
                                        <div class="row">
                                            {{-- Col --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Small</label>
                                                    <input type="number" min="0" value="0" name="products[0][s]"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            {{-- Col --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Medium</label>
                                                    <input type="number" min="0" value="0" name="products[0][m]"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            {{-- Col --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Large</label>
                                                    <input type="number" min="0" value="0" name="products[0][l]"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            {{-- Col --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>X-Large</label>
                                                    <input type="number" min="0" value="0" name="products[0][xl]"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            {{-- Col --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>XX-Large</label>
                                                    <input type="number" min="0" value="0" name="products[0][xxl]"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            {{-- Col --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>More</label>
                                                    <input type="number" min="0" value="0" name="products[0][more]"
                                                        class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Color*</label>
                                                <input type="color" name="products[0][color]" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Color Name*</label>
                                                <input type="text" name="products[0][color_name]" required>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <hr>
                            </div>


                            <div class="col-md-12">
                                <div class="d-flex justify-content-center mt-3 justify-content-between">
                                    <button type="button" class="btn btn-light post-cloth" id="add-btn">
                                        Add Product
                                    </button>
                                    <button type="submit" class="btn btn-primary post-cloth">Upload Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- =================== Accessories =================== --}}
        </div>
    </div>
</div>
<!--//////////////////////settings modal////////////////////////////////-->
<div class="modal settings-modal w-100 fade" id="settings" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg w-100 m-auto" role="document">
        <div class="modal-content p-5">
            <div id="close" data-dismiss="modal"><i class="fas fa-times fa-2x"></i></div>
            <div class="d-flex justify-content-center">
                <h3>Settings</h3>
            </div>
            <div class="container">
                <form action="{{ route("settings") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-md-12">
                        <lable>Profile Image</lable>
                        <div class="container">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Profile Image</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file">
                                                Browse <input type="file" id="imgInp" name="image">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <div class="image-show">
                                        <img class="img-fluid" id='img-upload' src="{{ $user->profile_pic }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <label for="fname">First Name:</label>
                        <input 
                               class="form-control" 
                               type="text" 
                               id="fname" 
                               placeholder="First Name" 
                               name="fname"
                               value="{{ $user->fname }}">
                    </div>
                    <div class="col-md-6 p-3">
                        <label for="lname">Last Name:</label>
                        <input 
                               class="form-control" 
                               type="text" 
                               id="lname" 
                               placeholder="First Name" 
                               name="lname"
                               value="{{ $user->lname }}">
                    </div>
                    <div class="col-md-6 p-3">
                        <label for="goernorate">Governorate:</label>
                        <select class="custom-select" id="governorate" name="governorate" required>
                            <option selected disabled value="">Governorate</option>
                            <option @if($user->governorate == "Alexandria") selected @endif value="Alexandria">Alexandria</option>
                            <option @if($user->governorate == "Aswan") selected @endif value="Aswan">Aswan</option>
                            <option @if($user->governorate == "Asyut") selected @endif value="Asyut">Asyut</option>
                            <option @if($user->governorate == "Beheira") selected @endif value="Beheira">Beheira</option>
                            <option @if($user->governorate == "Beni Suef") selected @endif value="Beni Suef">Beni Suef</option>
                            <option @if($user->governorate == "Cairo") selected @endif value="Cairo">Cairo</option>
                            <option @if($user->governorate == "Dakahlia") selected @endif value="Dakahlia">Dakahlia</option>
                            <option @if($user->governorate == "Damietta") selected @endif value="Damietta">Damietta</option>
                            <option @if($user->governorate == "Faiyum") selected @endif value="Faiyum">Faiyum</option>
                            <option @if($user->governorate == "Gharbia") selected @endif value="Gharbia">Gharbia</option>
                            <option @if($user->governorate == "Giza") selected @endif value="Giza">Giza</option>
                            <option @if($user->governorate == "Ismailia") selected @endif value="Ismailia">Ismailia</option>
                            <option @if($user->governorate == "Kafr El Sheikh") selected @endif value="Kafr El Sheikh">Kafr El Sheikh</option>
                            <option @if($user->governorate == "Luxor") selected @endif value="Luxor">Luxor</option>
                            <option @if($user->governorate == "Matruh") selected @endif value="Matruh">Matruh</option>
                            <option @if($user->governorate == "Minya") selected @endif value="Minya">Minya</option>
                            <option @if($user->governorate == "Monufia") selected @endif value="Monufia">Monufia</option>
                            <option @if($user->governorate == "New Valley") selected @endif value="New Valley">New Valley</option>
                            <option @if($user->governorate == "North Sinai") selected @endif value="North Sinai">North Sinai</option>
                            <option @if($user->governorate == "Port Said") selected @endif value="Port Said">Port Said</option>
                            <option @if($user->governorate == "Qalyubia") selected @endif value="Qalyubia">Qalyubia</option>
                            <option @if($user->governorate == "Qena") selected @endif value="Qena">Qena</option>
                            <option @if($user->governorate == "Red Sea") selected @endif value="Red Sea">Red Sea</option>
                            <option @if($user->governorate == "Sharqia") selected @endif value="Sharqia">Sharqia</option>
                            <option @if($user->governorate == "Sohag") selected @endif value="Sohag">Sohag</option>
                            <option @if($user->governorate == "South Sinai") selected @endif value="South Sinai">South Sinai</option>
                            <option @if($user->governorate == "Suez") selected @endif value="Suez">Suez</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <div class="about">
                            <label for="about">About:</label>
                            <textarea 
                                    class="form-control" 
                                    id="description" 
                                    placeholder="ِbout" 
                                    name="about"
                                    required>{{ $user->about }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-5 p-3">
                        <label for="phone">Phone:</label>
                        <input 
                                class="form-control" 
                                type="text" 
                                id="phone" 
                                name="phone"
                                value="{{ $user->phone }}"
                                placeholder="Phone">
                    </div>
                    <div class="col-md-6 p-3">
                        <lable for="DOB">Date of Birth</lable>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 pt-2">
                                    <select class="custom-select" id="days" name="day">
                                        <option selected disabled value="">days</option>
                                    </select>
                                </div>
                                <div class="col-md-4 pt-2">
                                    <select class="custom-select" id="months" name="month">
                                        <option selected disabled value="">months</option>
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                        <option>06</option>
                                        <option>07</option>
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                    </select>
                                </div>
                                <div class="col-md-4 pt-2">
                                    <select class="custom-select" id="years" name="year">
                                        <option selected disabled value="">years</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary saveChangesBtn">Save Changes</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection




{{-- ====================  Footer ==================== --}}
@section("footer")
<script src="/js/designer-profile.js"></script>
<script>
    let counter = 1;
    let inputsContainer = $("#inputs-container");
    $("#add-btn").click(()=>{
        inputsContainer.append(`
                                <div class="mb-3 col-12">
                                    <div class="form-group">
                                        <label>Image: </label>
                                        <input type="file" name="products[${counter}][image]" required>
                                    </div>
                                    <div class="form-group col-12">
                                        {{-- ====================== Sizes ====================== --}}
                                        <h4 class="d-block text-center">Sizes</h4>
                                        <div class="row">
                                            {{-- Col --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Small</label>
                                                    <input type="number" min="0" value="0" name="products[${counter}][s]" class="form-control">
                                                </div>
                                            </div>
                                            {{-- Col --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Medium</label>
                                                    <input type="number" min="0" value="0" name="products[${counter}][m]" class="form-control">
                                                </div>
                                            </div>
                                            {{-- Col --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Large</label>
                                                    <input type="number" min="0" value="0" name="products[${counter}][l]" class="form-control">
                                                </div>
                                            </div>
                                            {{-- Col --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>X-Large</label>
                                                    <input type="number" min="0" value="0" name="products[${counter}][xl]" class="form-control">
                                                </div>
                                            </div>
                                            {{-- Col --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>XX-Large</label>
                                                    <input type="number" min="0" value="0" name="products[${counter}][xxl]" class="form-control">
                                                </div>
                                            </div>
                                            {{-- Col --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>More</label>
                                                    <input type="number" min="0" value="0" name="products[${counter}][more]" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Color*</label>
                                                <input type="color" name="products[${counter}][color]" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Color Name*</label>
                                                <input type="text" name="products[${counter}][color_name]" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger btn-sm delete-btn">Delete this product</button>
                                    </div>
                                <hr>
                                </div>
        
        `)
        counter++;
    })


    inputsContainer.on("click", ".delete-btn", (e)=>{
        $(e.target).parent().parent().remove();
    })

    $("#type optgroup").hide(0);

    $("#category").on("change", function(){
        let typeGroupID = this.options[this.selectedIndex].getAttribute("data-category");
        $("#type optgroup").hide(0);
        $(typeGroupID).show(0);
        $("#type").val("");
    })

    // $('#post-form').submit(function(e) {
    //     // get all the inputs into an array.
    //     var $inputs = $('#post-form :input');

    //     // not sure if you wanted this, but I thought I'd add it.
    //     // get an associative array of just the values.
    //     console.log($inputs.length);
    //     var values = {};
    //     $inputs.each(function(el) {
    //         console.log(this.name, this.value)
    //         values[this.name] = $(this).val();
    //     });

    //     console.log(values);
    //     e.preventDefault();
    //     return false;

    // });


</script>
@endsection