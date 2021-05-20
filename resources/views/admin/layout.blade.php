@extends('layouts.layout')

@section("head")
<link rel="stylesheet" href="/css/customer-profile.css">
<style>
    .navbar .container{
        margin-left: auto;
        margin-right: auto;
    }
</style>
@endsection


@section("content")

<div class="container-fluid m-0 p-0">
    <div class="row p-0 m-0">
        <div class="col-12 p-0 m-0">
                @include("layouts.navbar")
        </div>
    </div>
</div>



<nav class="navbar navbar-light bg-primary navbar-expand py-0 mb-5">
    <ul class="navbar-nav justify-content-center text-dark my-0">
        <li class="nav-item">
            <a class="nav-link text-white py-2  {{ activeLink("profile") }}" style="font-size: 18px;" href="{{ route("profile") }}">Unactive Posts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white py-2  {{ activeLink("dashboard/posts/active") }}" style="font-size: 18px;" href="{{ route("admin.active") }}">Active Posts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white py-2  {{ activeLink("dashboard/orders/active") }}" style="font-size: 18px;" href="{{ route("admin.orders") }}">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white py-2  {{ activeLink("dashboard/requests") }}" style="font-size: 18px;" href="{{ route("admin.requests") }}">Requests</a>
        </li>
    </ul>
</nav>

@yield('admin-content')

@endsection