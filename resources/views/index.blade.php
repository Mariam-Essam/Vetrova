@extends('layouts.layout')

{{-- ==================== Head ==================== --}}
@section("head")
<link rel="stylesheet" href="css/index.css">
@endsection


{{-- ==================== Content ==================== --}}
@section("content")
<div class="home-page">
    <!-- ////////////////////  Upbutton  /////////////////////// -->
    <button class="btn btn-info upButton"><i class="fas fa-chevron-circle-up"></i></button>
    <!-- ////////////////////  Navbar  /////////////////////// -->
    <nav class="navbar navbar-expand-lg navbar-light pt-0 pb-0">
        <div class="container mt-0 mb-0">
            <a class="navbar-brand" href="/"><img class="vetrovalogo" src="/images/Logo.png" width="60"
                    height="60"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="h nav-link" href="#home">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="cat nav-link" href="#categories">CATEGORIES</a>
                    </li>
                    <li class="nav-item">
                        <a class="top-d nav-link" href="#top-designers">TOP DESIGNERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="top-p nav-link" href="#top-products">TOP PRODUCTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="serv nav-link" href="#services">SERVICES</a>
                    </li>
                    <button class="sign-in-btn btn btn-primary mx-3 px-3 py-2" data-toggle="modal"
                        data-target="#sign-in">Sign in</button>
                </ul>
            </div>
        </div>
    </nav>
    <!-- ///////////////////////////////////////  Home  /////////////////////////////////// -->
    <section class="home mb-5" id="home">
        <header class="head w-100">
            <div class="skitter skitter-large homing">
                <ul class="ul">
                    <li class="li">
                        <a href="#cut"><img src="images/index/home/1.jpg" width="3000px" height="600px"
                                class="cut img-fluid" /></a>
                        <div class="label_text pb-5 mb-5">
                            <h1 class="text-danger text-center">WELCOME TO VETROVA</h1>
                            <h3 class="text-center text-white">You Are Our Special Client</h3>
                        </div>
                    </li>
                    <li class="li">
                        <a href="#swapBlocks"><img src="images/index/home/2.jpg" width="3000px" height="600px"
                                class="swapBlocks img-fluid" /></a>
                        <div class="label_text pb-5 mb-5">
                            <h1 class="text-danger text-center">VETROVA</h1>
                            <h3 class="text-center text-white">Website that you will find your cloths in</h3>
                        </div>
                    </li>
                    <li class="li">
                        <a href="#swapBarsBack"><img src="images/index/home/3.png" width="3000px" height="600px"
                                class="swapBarsBack img-fluid" /></a>
                        <div class="label_text pb-5 mb-5">
                            <h1 class="text-danger text-center">WELCOME TO VETROVA</h1>
                            <h3 class="text-white text-center">Enjoy your trip in our website</h3>
                        </div>
                    </li>
                    <li class="li">
                        <a href="#swapBarsBack"><img src="images/index/home/4.jpeg" width="3000px" height="600px"
                                class="swapBarsBack img-fluid" /></a>
                        <div class="label_text pb-5 mb-5">
                            <h1 class="text-danger text-center">VETROVA</h1>
                            <h3 class="text-white text-center">Whether you are a designer or customer you will be
                                satisfied</h3>
                        </div>
                    </li>
                    <li class="li">
                        <a href="#swapBarsBack"><img src="images/index/home/5.jpeg" width="3000px" height="600px"
                                class="swapBarsBack img-fluid" /></a>
                        <div class="label_text pb-5 mb-5">
                            <h1 class="text-danger text-center">WELCOME TO VETROVA</h1>
                            <h3 class="text-white text-center">We hope to find what do you are looking for in our
                                website</h3>
                        </div>
                    </li>
                    <li class="li">
                        <a href="#swapBarsBack"><img src="images/index/home/6.jpeg" width="3000px" height="600px"
                                class="swapBarsBack img-fluid" /></a>
                        <div class="label_text pb-5 mb-5">
                            <h1 class="text-danger text-center">VETROVA</h1>
                            <h3 class="text-white text-center">Whether you are a designer or customer you will be
                                satisfied</h3>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
    </section>
    <!-- ////////////////////  categories/////////////////////// -->
    <div class="categories pb-5" id="categories">
        @if($categories->count())
        <h2 class="p-4 text-center text-white">Categories</h2>
        <div class="container">
            <div class="row justify-content-center">
                @foreach($categories as $cat)
                <div class="col-md-3">
                    <a href="{{ route("explore") }}?categories[]={{ $cat->id }}">
                        <div class="category my-3 d-flex justify-content-center align-items-center text-center">
                            <div class="category-background" style="background-image: url('{{ $cat->cover }}')">
                                <div class="category-overlay"></div>
                            </div>
                            <div class="D-name w-100 d-flex justify-content-center align-items-center text-center">
                                <h2 class="cat-word">{{ $cat->name }}</h2>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    <!-- //////////////////////top designer///////////////////// -->
    <section class="top-designers my-5 py-5 w-100" id="top-designers">
        <div class="container ">
            <h2 class="pt-4 text-center">Top Designers</h2>
            <div class="owl-carousel owl-theme mt-4 p-3 w-80 d-flex justify-content-center align-items-center">
                
                
                
                @foreach($users as $user)
                <div class="top-designer text-center m-2 d-flex justify-content-center align-items-center flex-column">
                    <div class="designer-photo">
                        <div class="image-overlay"></div>
                        <img class=" img-fluid" src="{{ $user->profile_pic }}" />
                        <div class="designer-name text-white">{{ $user->name }}</div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </section>
    <!-- ///////////////////top trends///////////////////////// -->
    <section class="top-products mt-4 mx-5 px-5" id="top-products">
        <h2>Top Products</h2>
        <div class="mb-3 text-center">
            <div class="owl-carousel owl-theme mt-4 w-80 d-flex justify-content-center align-items-center">
                @foreach($products as $p)
                <div class="single-trend">
                    <div class="image"><img class=" img-fluid w-100" src="{{ Storage::url($p->path) }}" />
                        <div
                            class="image-overlay text-white d-flex align-items-center justify-content-center flex-column">
                            <p>Designer name</p><span>{{ $p->post->user->name }}</span>
                        </div>
                    </div>
                    <div class="trend-info p-3 text-center">
                        <div class="rating-wrapper pb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $p->rate)
                                <span style="color: #df0">
                                    <i class="fas fa-star"></i>
                                </span>
                                @else
                                <span>
                                    <i class="fas fa-star"></i>
                                </span>
                                @endif
                            @endfor
                        </div>
                        <div class="trend-type pb-2">{{ $p->post->category->name }}</div>
                        <div class="trend-price pb-2">
                            <p class="price">{{ $p->price }}</p><span class="currency">L.E</span>
                        </div>
                    </div>
                </div>
                @endforeach
                
                
                
            </div>
        </div>
    </section>
    <!-- //////////////////////////////////////////services////////////////////////////////// -->
    <section id="services" class="services py-5">
        <div class="service">
            <div class=" p-4 service-section mt-4 " id="services">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-center">
                                <h2>Services</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="services col-md-12">
                            <div class="single-service">
                                <div class="single-service-inner">
                                    <i class="fas fa-paint-brush mb-4 fa-3x"></i>
                                    <h3>Design</h3>
                                    <p>You can embrace your creative side by designing your own custom, and our
                                        professional designer will make it.</p>
                                </div>
                            </div>
                            <div class="single-service">
                                <div class="single-service-inner">
                                    <i class="fas fa-truck mb-4 fa-3x"></i>
                                    <h3>Deliver</h3>
                                    <p>your chosen custom will deliver to you wherever you go as soon as possible.</p>
                                </div>
                            </div>
                            <div class="single-service">
                                <div class="single-service-inner">
                                    <i class="fas fa-address-book mb-4 fa-3x"></i>
                                    <h3>Contact</h3>
                                    <p>you can reach our professional designer about your design if you want any change
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/////////////////////////////////////footer//////////////////////////////-->
    <!-- ////////////////////////footer/////////////////////////////// -->
    
</div>
<!--/////////////////////////////////// Sign in pop up window////////////////////////////////-->
<div class="modal sign-modal w-100 fade" id="sign-in" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg w-100 m-auto" role="document">
        <div class="modal-content p-5">
            <div id="close" data-dismiss="modal"><i class="fas fa-times fa-2x"></i></div>
            <section class="logo m-auto text-center"><img class="img-fluid" src="images/Logo.png" /></section>
            <section class="nav2 m-auto">
                <div class="navigation m-auto text-center">
                    <div class="sign-in-div sign">
                        <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
                        <label for="tab-1" class="tab sign-word mx-4" href="#">Sign In</label>
                    </div>
                    <div class="sign-up-div sign">
                        <input id="tab-2" type="radio" name="tab" class="sign-up">
                        <label for="tab-2" class="tab sign-word mx-4" href="#">Sign Up</label>
                    </div>
                </div>
                <div class="login-form">
                    <form class="signin-form my-3" action="{{ route("login") }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12 m-auto">
                                <input type="email" class="form-control emailinput inputs" id="inputEmail"
                                    placeholder="Email" name="email">
                            </div>
                        </div>
                        <div class="form-group row my-3">
                            <div class="col-sm-12 m-auto password">
                                <input type="password" class="form-control passinput inputs" id="inputPassword"
                                    placeholder="Password" name="password">
                                <a class="showPass"><i class="fas fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center text-center">
                            <button class="btn btn-primary signinBtn"> <i class="fas fa-sign-in-alt"></i> Sign
                                In</button></div>
                    </form>

                    {{-- ======================== Register Form ======================== --}}
                    <form class="signup-form my-3" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3 signup-type">
                                <label class="pr-3">Yor are sign up as: </label>
                                <div class="custom-control custom-radio mr-3 d-inline">
                                    <input type="radio" class="custom-control-input signup-input" id="customer-type"
                                        name="type" value="customer" required>
                                    <label class="custom-control-label user-type" for="customer-type">Customer</label>
                                </div>
                                <div class="custom-control custom-radio mb-3 ml-3 d-inline">
                                    <input type="radio" class="custom-control-input signup-input" id="designer-type"
                                        name="type" value="designer" required>
                                    <label class="custom-control-label user-type" for="designer-type">Designer</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="first-name">First name:</label>
                                <input type="text" class="form-control is-valid signup-input first-name" id="first-name"
                                    placeholder="First name" name="fname" required>
                                <div class="valid-feedback feedback">
                                    First name must be at least 3 letters and started by capital! 
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last-name">Last name:</label>
                                <input type="text" class="form-control is-valid signup-input last-name" id="last-name"
                                    placeholder="Last name" name="lname" required>
                                <div class="valid-feedback feedback">
                                    Last name must be at least 3 letters and started by capital! 
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="custom-control custom-radio mr-3 d-inline">
                                    <input type="radio" class="custom-control-input signin-input" id="male"
                                        name="gender" value="male" required>
                                    <label class="custom-control-label" for="male">Male</label>
                                </div>
                                <div class="custom-control custom-radio mb-3 ml-3 d-inline">
                                    <input type="radio" class="custom-control-input signin-input" id="female"
                                        name="gender" value="female" required>
                                    <label class="custom-control-label" for="female">Female</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control is-valid signup-input email" id="email"
                                    placeholder="Email" name="email" required>
                                <div class="valid-feedback feedback">
                                    Ex: name@username.com
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 class">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control is-valid signup-input sign-up-password"
                                    id="password" placeholder="Password" name="password" required>
                                <a class="showInputPass"><i class="fas fa-eye"></i></a>
                                <div class="valid-feedback feedback">
                                    Password must be at least 6, contains at least numeric digit, one uppercase and one lowercase letter!
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 class">
                                <label for="confirm-pass">Confirm Password:</label>
                                <input type="password" class="form-control is-valid signup-input confirm-password"
                                    id="confirm-pass" placeholder="Confirm Password" name="password_confirmation" required>
                                <a class="showConfirmPass"><i class="fas fa-eye"></i></a>
                                <div class="valid-feedback feedback">
                                    It must be as same as the password!
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center text-center">
                            <button type="submit" class="btn btn-primary signupBtn">Sign Up</button></div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection




{{-- ====================  Footer ==================== --}}
@section("footer")
<script src="js/index.js"></script>
<script>

    

</script>
@endsection