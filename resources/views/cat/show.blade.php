@extends('layouts.layout')

{{-- Head sectoin --}}
@section("head")
<link rel="stylesheet" href="/css/category.css">
@endsection

{{-- Content sectoin --}}
@section("content")
@include("layouts.navbar")
<div class="container cont">
    <div class="px-2 py-0">
        <div class="row">
            <form class="category float-left fixed-left p-3 my-2 rounded col-3" method="GET">
                <div class="for mt-3">
                    <li>For:
                        <ul>
                            @foreach($categories as $cat)
                                <li>
                                    <label for="cat{{ $cat->id }}">
                                        <input 
                                            class="cat" 
                                            type="checkbox" 
                                            name="categories[{{ $cat->id }}]" 
                                            id="cat{{ $cat->id }}" value="{{ $cat->id }}"
                                            @if(in_array($cat->id, $cats)) checked @endif >
                                        {{ $cat->name }}
                                    </label>
                                    @if($cat->types->count())
                                        <ul>
                                            @foreach($cat->types as $type)
                                            <li>
                                                <label for="type{{ $type->id }}">
                                                    <input 
                                                        class="type" 
                                                        type="checkbox" 
                                                        name="types[{{ $type->id }}]" 
                                                        id="type{{ $type->id }}" 
                                                        value="{{ $type->id }}"
                                                        @if(in_array($type->id, $types)) checked @endif >
                                                    {{ $type->name }}
                                                    
                                                </label>
                                            </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </div>
                <div class="Size">
                    <li>Size:
                        <ul>
                            <li>
                                <label for="filter-small">
                                    <input type="checkbox" @if(isset($_GET["s"])) checked @endif name="s" id="filter-small">Small</li>
                                </label>
                            <li>
                                <label for="filter-medium">
                                    <input type="checkbox" @if(isset($_GET["m"])) checked @endif name="m" id="filter-medium">Medium</li>
                                </label>
                            <li>
                                <label for="filter-large">
                                    <input type="checkbox" @if(isset($_GET["l"])) checked @endif name="l" id="filter-large">Large</li>
                                </label>
                            <li>
                                <label for="filter-xlarge">
                                    <input type="checkbox" @if(isset($_GET["xl"])) checked @endif name="xl" id="filter-xlarge">X-large</li>
                                </label>
                            <li>
                                <label for="filter-xxlarge">
                                    <input type="checkbox" @if(isset($_GET["xxl"])) checked @endif name="xxl" id="filter-xxlarge">XX-large</li>
                                </label>
                            <li>
                                <label for="filter-more">
                                    <input type="checkbox" @if(isset($_GET["more"])) checked @endif name="more" id="filter-more">More</li>
                                </label>
                        </ul>
                    </li>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-3 py-2">Filter</button>
                </div>
            </form>
            <div class="col-md-9 products">
                <div class="container">
                    <div class="row">
                        {{-- @php
                         dd($posts);   
                        @endphp --}}
                        @if($posts->count())
                        @foreach($posts as $p)
                        
                            @component('components.post', ["p" => $p])
                            @endcomponent
                            
                        @endforeach
                        <div class="d-flex justify-content-center">
                            {{ $posts->links() }}
                        </div>
                        @else
                            <h1 class="text-center">There's no posts matches your search</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ////////////////////////footer/////////////////////////////// -->

@endsection


{{-- Footer section --}}
@section("footer")
<script src="/js/category.js"></script>
<script>
    $(".cat").on("click", function(){
        const cat = this;
        $(this).parent().parent().find(".type").each((index, type) => { type.checked = cat.checked;});
    });

    $(".type").on("click", function(){

        let all = true;
        $(this).parent().parent().parent().find(".type").each((index, type) => {
            if(!type.checked){
                all = false;
                return;
            }
        })
        $(this).parent().parent().parent().parent().find(".cat").each((index, cat) => {cat.checked = all});
        

    });

</script>
@endsection