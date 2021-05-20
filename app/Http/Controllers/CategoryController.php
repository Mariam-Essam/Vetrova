<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function __construct()
    {
        $this->middleware("role:admin", ["except" => ["show", "index"]]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with("types")->get();

        return view("admin.categories", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validateWithBag( "storeCategory",[
            "name" => "required|string|min:3",
            "image" => "required|image|max:2048",
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->image = $request->image->store("public/images");

        $category->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    // public function show(Category $category)
    // {
    //     $posts = $category->posts()
    //                         ->orderBy("created_at", "DESC")
    //                         ->where("active", "=", 1)
    //                         ->with(["user", "products", "type"])
    //                         ->paginate();

    //     return view("cat.show", compact("posts"));
    // }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validateWithBag( "updateCategory",[
            "category" => "required|numeric|exists:categories,id",
            "name" => "required|string|min:3",
            "image" => "nullable|image|max:2048",
        ]);

        $category = Category::where("id", $request->category)->firstOrFail();

        $category->name = $request->name;
        $category->image = $request->image ? $request->image->store("public/images") : $category->image;

        $category->save();


        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
