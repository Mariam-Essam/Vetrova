
@if(Auth::check())
@php
    $user = Auth::user();
@endphp
<!--////////////////////////////navbar///////////////////////////////////-->
<nav class="navbar navbar-expand-sm navbar-light p-0 m-0 w-100 navbar-main" style="background-color: #2C566A;">
    <div class="container mt-0 mb-0">
        <a class="navbar-brand" href="/"><img class="vetrovalogo" src="/images/Logo.png" width="45" height="45"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="search px-5 mr-auto">
            <form action="{{ route("explore") }}" method="GET">
                <input class="search-input form-control" placeholder="Search" name="q">
            </form>
        </div>
        @if(Auth::check() && $user->isAdmin())
        <div class="mx-auto col-md-4 text-center">
            <h2 style="margin: 0px;">Dashboard</h2>
        </div>
        @endif
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link mx-2 {{ activeLink("profile") }}" href="{{ route("profile") }}"><i class="fas fa-home text-white"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2 {{ activeLink("explore") }}" href="{{ route("explore") }}"><i class="fas fa-search text-white"></i></a>
                </li>
                @if(Auth::user()->type == "customer")
                <li class="nav-item">
                    <a class="nav-link mx-2 {{ activeLink("cart") }}" href="{{ route("user.cart") }}"><i class="fas fa-shopping-cart text-white"></i></a>
                </li>
                @endif
                @if($user->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link mx-2 {{ activeLink("category/create") }}" href="{{ route("category.create") }}"><i class="fas fa-dumpster text-white"></i></a>
                    </li>
                @endif
                <div class="image ml-2">
                    <img class="img-fluid" src="{{ $user->profile_pic }}">
                </div>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item settings-btn" data-toggle="modal" data-target="#settings"><i
                                class="fas fa-cog"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item log-out" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Log out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
@else 
<nav class="navbar navbar-expand-lg navbar-light pt-0 pb-0">
    <div class="container mt-0 mb-0">
        <a class="navbar-brand" href="/"><img  class="vetrovalogo" src="/images/Logo.png" width="40" height="40"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="h nav-link" href="/">HOME</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endif