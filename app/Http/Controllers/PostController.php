<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{

    public function __construct()
    {
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "price" => "required|numeric",
            "governorate" => "required|string|max:15",
            "street"    => "required",
            "address"   => "required",
            "house_number" => "required",
            "phone1"    => "required",
            "phone2"    => "nullable",
            "description"   => "required|string|min:10|max:500",

            // Category & Type
            "category"  => "required|numeric|exists:categories,id",
            "type"  => "nullable|numeric|exists:types,id",

            // Products
            "products"    => "required|array",
            "products.*.image"    => "required|image|max:2048",
            "products.*.color"    => "required|string",
            "products.*.color_name"    => "required|string",
            // Product sizes
            "products.*.s"  => "required|numeric|min:0",
            "products.*.m"  => "required|numeric|min:0",
            "products.*.l"  => "required|numeric|min:0",
            "products.*.xl"  => "required|numeric|min:0",
            "products.*.xxl"  => "required|numeric|min:0",
            "products.*.more"  => "required|numeric|min:0",

        ]);






        $post = new Post();

        $post->description = $request->description;
        $post->price = $request->price;

        $post->governorate = $request->governorate;
        $post->street = $request->street;
        $post->address = $request->address;
        $post->house_number = $request->house_number;
        $post->phone1 = $request->phone1;
        $post->phone2 = $request->phone2;


        $post->category_id = $request->category;
        $post->type_id = $request->type;
        $post->user_id = Auth::id();


        $post->save();

        // Add products
        foreach ($request->products as $p) {
            $product = new Product();

            $product->path = $p['image']->store("public/images");
            $product->color = $p['color'];
            $product->color_name = $p['color_name'];

            // Sizes
            $product->s = $p['s'];
            $product->m = $p['m'];
            $product->l = $p['l'];
            $product->xl = $p['xl'];
            $product->xxl = $p['xxl'];
            $product->more = $p['more'];

            $product->post()->associate($post);

            $product->save();
        }


        Session::flash("success", "Your product is added successfully");

        return redirect()->route("profile");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if(!$post->active){
            return abort(401);
        }

        $post->load(["category", "type", "user"]);
        
        return view("post.show", ["post" => $post]);
    }

    /**
     * Edit the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post->load(["type", "user", "category", "type"]);

        return view("admin.edit_post", ["post" => $post]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            "product" => "array|required",
            // Product sizes
            "product.*.id"  => "required|numeric",
            "product.*.s"  => "required|numeric",
            "product.*.m"  => "required|numeric",
            "product.*.l"  => "required|numeric",
            "product.*.xl"  => "required|numeric",
            "product.*.xxl"  => "required|numeric",
            "product.*.more"  => "required|numeric",
        ]);
        

        foreach ($request->product as $p) {
            $product = Product::find($p['id']);

            $product->s = $product->s + $p['s'];
            $product->m = $product->m + $p['m'];
            $product->l = $product->l + $p['l'];
            $product->xl = $product->xl + $p['xl'];
            $product->xxl = $product->xxl + $p['xxl'];
            $product->more = $product->more + $p['more'];

            $product->save();
        }

        $post->active = $request->active ? true : false;

        $post->save();

        Session::flash("success", "Post updated successfully");

        return redirect()->route("post.edit", ["post" => $post->id]);
    }


    /**
     * Explore all posts and filter with search
     */
    public function explore(Request $request){

        $query = Post::where("active", "=", 1)
                        ->orderBy("created_at", "DESC")
                        ->with(["category", "type", "user", "products"]);

        $cats = false;
        if($request->categories){
            $query->whereIn("category_id", $request->categories);
            $cats = true;
        }

        if($request->q){
            $query->where("description", "LIKE", "%" . $request->q . "%");
        }

        if($request->types){
            if($cats){
                $query->whereIn("type_id", $request->types);
            } else {
                $query->whereIn("type_id", $request->types);
            }
        }

        // Filter sizes
        if($request->s) $query->whereHas("products", function($q){ $q->where("s", ">", 0); return $q; });
        if($request->m) $query->whereHas("products", function($q){ $q->where("m", ">", 0); return $q; });
        if($request->l) $query->whereHas("products", function($q){ $q->where("l", ">", 0); return $q; });
        if($request->xl) $query->whereHas("products", function($q){ $q->where("xl", ">", 0); return $q; });
        if($request->xxl) $query->whereHas("products", function($q){ $q->where("xxl", ">", 0); return $q; });
        if($request->more) $query->whereHas("products", function($q){ $q->where("more", ">", 0); return $q; });


        $posts = $query->paginate();
        $categories = Category::with("types")->get();
        $cats = $request->categories ?? []; 
        $types = $request->types ?? []; 

        return view("cat.show", compact("posts", "categories", "cats", "types"));
    }

}
