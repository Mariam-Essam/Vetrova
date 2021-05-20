@extends("admin.layout")

@section("admin-content")

<div class="container mx-auto mt-4">
    <div class="row">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Create Cateogries --}}
        <div class="col-md-6">
            <h4 class="text-center">Create New Category</h4>
            <form action="{{ route("category.store") }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control">
                    @if($errors->storeCategory->first('name'))
                    <small class="text-danger">
                        {{ $errors->storeCategory->first('name') }}
                    </small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="image">
                        Cover Image:
                    </label>
                    <input type="file" name="image" id="image">
                    @if($errors->storeCategory->first('image'))
                    <small class="text-danger">
                        {{ $errors->storeCategory->first('image') }}
                    </small>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>



        {{-- Update category --}}
        <div class="col-md-6">
            <h4 class="text-center">Update Category</h4>
            <form action="{{ route("category.update") }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <select name="category" id="cat-select" class="form-control" required>
                        <option value="">-- Select Cateogry --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cat-name">Cateogry name</label>
                    <input type="text" name="name" id="cat-name" class="form-control" required>
                    @if($errors->updateCategory->first('name'))
                    <small class="text-danger">
                        {{ $errors->updateCategory->first('name') }}
                    </small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="image">Cover Image:</label>
                    <input type="file" name="image" id="image">
                    @if($errors->storeCategory->first('image'))
                    <small class="text-danger">
                        {{ $errors->storeCategory->first('image') }}
                    </small>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>

    </div>

    <div class="row mt-4">
        {{-- Create Type --}}
        <div class="col-md-6">
            <h4 class="text-center">Create New Type</h4>
            <form action="{{ route("type.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <select name="category" class="form-control" required>
                        <option value="">-- Select Cateogry --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cat-name">Type name</label>
                    <input type="text" name="name" class="form-control" required>
                    @if($errors->storeType->first('name'))
                    <small class="text-danger">
                        {{ $errors->storeType->first('name') }}
                    </small>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </form>
        </div>


        {{-- Create Type --}}
        <div class="col-md-6">
            <h4 class="text-center">Edit Type</h4>
            <form action="{{ route("type.update") }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <select name="type" id="type-select" class="form-control" required>
                        <option value="">-- Select Type --</option>
                        @foreach($categories as $cat)
                            @if($cat->types->count())
                            <optgroup label="{{ $cat->name }}">
                                @foreach($cat->types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </optgroup>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cat-name">Type name</label>
                    <input type="text" name="name" id="type-name" class="form-control" required>
                    @if($errors->updateType->first('name'))
                    <small class="text-danger">
                        {{ $errors->updateType->first('name') }}
                    </small>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>



    </div>


</div>

@endsection


@section("footer")

<script>
    $("#cat-select").on("change", function(){
        $("#cat-name").val(this.options[this.selectedIndex].innerText);
    })

    $("#type-select").on("change", function(){
        $("#type-name").val(this.options[this.selectedIndex].innerText);
    })
</script>
    
@endsection