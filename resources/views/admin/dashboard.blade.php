@extends('admin.layout')

@section("head")
    <link rel="stylesheet" href="/css/category.css">
@endsection


@section("admin-content")


<div class="container">
    <div class="row">
        @if($posts->count())
            @foreach($posts as $p)
                @component('components.post', ["p" => $p])
                @endcomponent
            @endforeach
        @else
            <h1 class="text-center">There's no posts matches your request</h1>
        @endif
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>

@endsection


@section("footer")
<script src="/js/category.js"></script>
@endsection